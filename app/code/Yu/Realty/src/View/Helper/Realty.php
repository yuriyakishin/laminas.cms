<?php

namespace Yu\Realty\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Realty\Entity\Realty as RealtyEntity;
use Yu\Realty\Entity\Agent;

class Realty extends AbstractHelper
{
    private $typeName = [
        'sale-flat' => ['Продается квартира'],
        'sale-house' => ['Продается дом'],
    ];

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var \Yu\Realty\Service\RealtyManager
     */
    private $realtyManager;

    /**
     * @var \Yu\Realty\Repository\RealtyRepository
     */
    private $realtyRepository;

    /**
     * Realty constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param \Yu\Realty\Service\RealtyManager $realtyManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager,
        \Yu\Realty\Service\RealtyManager $realtyManager
    )
    {
        $this->entityManager = $entityManager;
        $this->realtyManager = $realtyManager;
        $this->realtyRepository = $entityManager->getRepository(RealtyEntity::class);
    }

    /**
     * @param string|null $type
     * @return string
     */
    public function getCount(string $type = null)
    {
        $countSelect = $this->realtyRepository->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.active = 1');

        if ($type !== null) {
            $countSelect->where("r.type = '" . $type . "'");
        }

        $count = $countSelect->getQuery()->getSingleScalarResult();

        return (string)$count;
    }

    /**
     * @param null $realty
     * @return mixed|string
     */
    public function getTypeName($realty = null, $ofset = 0)
    {
        if ($realty === null) {
            return '';
        }

        $type = '';

        if (is_array($realty)) {
            $type = $realty['type'];
        }

        if ($realty instanceof RealtyEntity) {
            $type = $realty->getType();
        }

        if (!empty($type)) {
            return $this->typeName[$type][$ofset];
        } else {
            return '';
        }

    }

    public function getRealtyParams($realtyId)
    {
        $realty = $this->realtyRepository->find($realtyId);
        $params = $this->realtyManager->getRealtyParams($realty);
        return $params;
    }

    public function getRealtyAttr($realtyId, $type)
    {
        $attr = $this->realtyManager->getRealtyAttr($realtyId, $type);
        return $attr;
    }

    public function getAgent(int $agentId)
    {
        $agent = $this->entityManager->getRepository(Agent::class)->find($agentId);
        return $agent;
    }


}