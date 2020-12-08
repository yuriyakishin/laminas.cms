<?php

namespace Yu\Realty\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Realty\Entity\Realty as RealtyEntity;
use Yu\Realty\Entity\Agent;
use Yu\Core\DataHelper;

class RealtyHelper extends AbstractHelper
{
    private $typeName = [
        'sale-flat' => ['Продается квартира', 'Продажа квартир', '%s - комнатная квартира'],
        'sale-house' => ['Продается дом', 'Продажа домов', '%s - комнатный дом'],
        'sale-commercial' => ['Продается %s', 'Продажа комменческой недвижимости', '%s'],
    ];

    /**
     * @var array
     */
    private $config;

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
        \Yu\Realty\Service\RealtyManager $realtyManager,
        array $config
    )
    {
        $this->entityManager = $entityManager;
        $this->realtyManager = $realtyManager;
        $this->realtyRepository = $entityManager->getRepository(RealtyEntity::class);
        $this->config = $config;
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
     * @param int $ofset
     * @param string $str
     * @return mixed|string
     */
    public function __getTypeName($realty = null, int $ofset = 0, $str = '')
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

        if (is_string($realty)) {
            $type = $realty;
        }

        if (!empty($type)) {
            $typeName = $this->typeName[$type][$ofset];
            $typeName = str_replace('%s', $str, $typeName);
            return $typeName;
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

    public function getLabel(string $type, string $path, string $str = null)
    {
        $label = $this->config[$type]['labels'][$path];
        $str = DataHelper::getCurrentLangValue($str);
        $label = str_replace('%s', $str, $label);
        return $label;
    }

    public function getRealtyHot(array $criterial = null, array $orderBy = null, int $limit = null, int $offset = null)
    {
        $realtyHot = $this->realtyRepository->findBy(['main' => 1], $orderBy, $limit, $offset);
        return $realtyHot;
    }

    public function getRealtyItem(int $realtyId, string $type = null)
    {
        if(!empty($realtyId)) {
            $item = $this->realtyManager->getRealtyItem($realtyId, $type);
            return $item;
        } else {
            return null;
        }
    }

    public function getTabId(string $type)
    {
        if(in_array($type,['sale-flat','sale-house','sale-commercial','sale-land'])) {
            return 'sale';
        }

        if(in_array($type,['rent-flat','rent-house','rent-commercial'])) {
            return 'rent';
        }

        if(in_array($type,['rent-apartment'])) {
            return 'apartment';
        }

        return 'sale';
    }

    public function getRealtyType(string $type)
    {
        if(in_array($type,['sale-flat','rent-flat','sale-commercial','sale-land'])) {
            return 'flat';
        }

        if(in_array($type,['sale-flat','sale-house','sale-commercial','sale-land'])) {
            return 'sale';
        }

        if(in_array($type,['rent-flat','rent-house','rent-commercial'])) {
            return 'rent';
        }

        if(in_array($type,['rent-apartment'])) {
            return 'apartment';
        }

        return 'sale';
    }
}