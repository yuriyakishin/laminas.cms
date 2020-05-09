<?php

namespace Yu\Realty\Service;

use Yu\Realty\Entity\Realty;
use Laminas\Serializer\Adapter;
use Laminas\Serializer\Serializer;

class RealtyManager
{
    /**
     * @var array
     */
    private $entityValueClass = [
        'int' => \Yu\Realty\Entity\RealtyValueInt::class,
        'text' => \Yu\Realty\Entity\RealtyValueText::class,
    ];

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var RealtyConfigManager
     */
    private $realtyConfigManager;

    /**
     * RealtyManager constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager,
        \Yu\Realty\Service\RealtyConfigManager $realtyConfigManager
    )
    {
        $this->entityManager = $entityManager;
        $this->realtyConfigManager = $realtyConfigManager;
    }

    public function getRealtyParams(Realty $realty = null)
    {
        $params = [];
        if($realty !== null) {
            $attributes = $this->realtyConfigManager->getRealtyAttributes($realty->getType());

            foreach ($attributes as $attr) {
                $repository = $this->entityManager->getRepository($this->entityValueClass[$attr['type']]);
                /**
                 * @var \Yu\Realty\Entity\RealtyValueInterface $entity
                 */
                $entity = $repository->findOneBy([
                    'entityId' => $realty->getId(),
                    'attributeId' => $attr['id'],
                ]);

                if (!empty($entity)) {
                    $params[$attr['code']] = $entity->getValue();
                }
            }
        }

        return $params;
    }

    public function saveParams(Realty $realty, array $data)
    {
        $serializer = Serializer::factory(Adapter\PhpSerialize::class);
        $attributes = $this->realtyConfigManager->getRealtyAttributes($realty->getType());

        foreach($attributes as $attr)
        {
            $repository = $this->entityManager->getRepository($this->entityValueClass[$attr['type']]);
            /**
             * @var \Yu\Realty\Entity\RealtyValueInterface $entity
             */
            $entity = $repository->findOneBy([
                'entityId' => $realty->getId(),
                'attributeId' => $attr['id'],
            ]);

            if(empty($entity)) {
                $entity = new $this->entityValueClass[$attr['type']];
            }

            if(isset($data['params'][$attr['code']])) {
                $value = $data['params'][$attr['code']];

                if(is_array($value)) {
                    $value = $serializer->serialize($value);
                }

                $entity->setEntityId($realty->getId());
                $entity->setAttributeId($attr['id']);
                $entity->setValue($value);

                $repository->save($entity);
            }
        }
    }
}