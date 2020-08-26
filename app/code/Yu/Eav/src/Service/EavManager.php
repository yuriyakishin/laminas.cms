<?php

namespace Yu\Eav\Service;

class EavManager
{
    /**
     * @var array
     */
    private $entityValueClass;

    /**
     * @var array
     */
    private $config;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager,
        array $config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
        $this->entityValueClass = $config['class'];
    }

    public function getEntityAttributes(string $attributeSet, int $entityId)
    {
        $_attributes = [];

        foreach ($this->config['attribute-set'][$attributeSet] as $set) {
            $attrParam = $this->config['attribute'][$set['attribute']];
            $repository = $this->entityManager->getRepository($this->entityValueClass[$attrParam['type']]);
            $entity = $repository->findOneBy([
                'entityId' => $entityId,
                'attributeId' => $attrParam['id'],
            ]);

            if (!empty($entity)) {
                $_attributes[$attrParam['code']] = $entity->getValue();
            }
        }

        return $_attributes;
    }

}