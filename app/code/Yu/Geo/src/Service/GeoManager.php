<?php

namespace Yu\Geo\Service;

use Yu\Geo\Entity\Marker;

class GeoManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * RealtyManager constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $path
     * @param int $pathId
     * @param array $data
     * @return object|Marker|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(string $path, int $pathId, array $data)
    {
        $repository = $this->entityManager->getRepository(Marker::class);
        $entity = $repository->findOneBy([
            'path' => $path,
            'pathId' => $pathId,
        ]);

        if(empty($entity)) {
            $entity = new Marker();
        }

        $entity->setPath($path);
        $entity->setPathid($pathId);
        $entity->setAddress($data['address']);
        $entity->setLat($data['lat']);
        $entity->setLng($data['lng']);
        $entity->setMark($data['mark']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}