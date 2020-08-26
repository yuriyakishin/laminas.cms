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

    /**
     * @param Realty|null $realty
     * @return array
     */
    public function getRealtyParams(Realty $realty = null)
    {
        $params = [];
        if ($realty !== null) {
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

    /**
     * @param int $realtyId
     * @param string $type
     * @return array
     */
    public function getRealtyAttr(int $realtyId, string $type)
    {
        $attributes = [];
        $_attributes = $this->realtyConfigManager->getRealtyAttributes($type);

        foreach ($_attributes as $_attr) {
            $repository = $this->entityManager->getRepository($this->entityValueClass[$_attr['type']]);
            /**
             * @var \Yu\Realty\Entity\RealtyValueInterface $entity
             */
            $entity = $repository->findOneBy([
                'entityId' => $realtyId,
                'attributeId' => $_attr['id'],
            ]);

            if (!empty($entity)) {
                $attributes[] = array_merge($_attr, ['value' => $entity->getValue()]);
            }
        }

        return $attributes;
    }

    /**
     * @param int $limit
     * @param int|null $offset
     * @return mixed
     */
    public function getRealtyHot(array $criterial = null, array $orderBy = null, int $limit = null, int $offset = null)
    {
        $realtyHot = $this->entityManager->getRepository(Realty::class)->findBy(['main' => 1], $orderBy, $limit, $offset);
        return $realtyHot;
    }

    /**
     * @param int $realtyId
     * @param string|null $type
     * @return mixed|null
     */
    public function getRealtyItem(int $realtyId, string $type = null)
    {
        if ($type === null) {
            $realty = $this->entityManager->getRepository(Realty::class)->find($realtyId);
            $type = $realty->getType();
        }

        $config = $this->realtyConfigManager->getRealtyConfig($type);
        if (isset($config["repository"]["realty-repository"]) && isset($config["repository"]["criterial-bilder"])) {
            $repository = new $config["repository"]["realty-repository"]($this->entityManager);
            $criterialBilder = new $config["repository"]["criterial-bilder"];

            $queryBuilder = $repository->getQueryBuilder();
            $realtyItem = $criterialBilder->build($queryBuilder, ['id' => $realtyId])->getQuery()->getResult();
            return $realtyItem[0];
        }

        return null;
    }

    /**
     * @param Realty $realty
     * @param array $data
     */
    public function saveParams(Realty $realty, array $data)
    {
        $serializer = Serializer::factory(Adapter\PhpSerialize::class);
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

            if (empty($entity)) {
                $entity = new $this->entityValueClass[$attr['type']];
            }

            if (isset($data['params'][$attr['code']])) {
                $value = $data['params'][$attr['code']];

                if (is_array($value)) {
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