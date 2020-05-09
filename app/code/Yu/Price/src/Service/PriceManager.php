<?php

namespace Yu\Price\Service;

use Yu\Price\Entity\Price;

class PriceManager
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        \Doctrine\ORM\EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $param['siteId','path','pathId']
     * @param array $data
     * @return object|Price|null
     */
    public function save(array $param, array $data)
    {
        $repository = $this->entityManager->getRepository(Price::class);
        $price = $repository->findOneBy($param);
        if(empty($price)) {
            $price = new Price();
        }

        $price->setSiteId($param['siteId']);
        $price->setPath($param['path']);
        $price->setPathId($param['pathId']);
        $price->setCurrencyId($data['currency_id']);
        $price->setValue($data['value']);
        $price->setMain(1);

        $this->entityManager->persist($price);
        $this->entityManager->flush();

        return $price;
    }

    /**
     * @param array $param['siteId','path','pathId']
     * @return object|Price|null
     */
    public function getPriceByParam(array $param)
    {
        $repository = $this->entityManager->getRepository(Price::class);
        $price = $repository->findOneBy($param);
        if(empty($price)) {
            $price = new Price();
        }

        return $price;
    }
}