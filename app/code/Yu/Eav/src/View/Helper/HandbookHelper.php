<?php

namespace Yu\Eav\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Laminas\Json\Json;
use Yu\Eav\Entity\EavValueOption;
use Yu\Site\ValueObject\Lang;
use Yu\Core\DataHelper;

class HandbookHelper extends AbstractHelper
{
    /**
     * @var $entityManager
     */
    private $entityManager;

    /**
     * @var \Yu\Eav\Service\ValueOptionManager
     */
    private $valueOptionManager;

    public function __construct($entityManager, $valueOptionManager)
    {
        $this->entityManager = $entityManager;
        $this->valueOptionManager = $valueOptionManager;
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function get(string $type)
    {
        $valueOptionModel = $this->valueOptionManager->createModel($type);

        $entities = $this->entityManager->getRepository(EavValueOption::class)->findBy([
            'optionId' => $valueOptionModel->getId(),
        ], [
            'sort' => 'ASC',
        ]);

        return $entities;
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function getJson(string $type, \Closure $cl = null)
    {
        $entities = $this->get($type);

        $data = [];
        foreach ($entities as $entity) {
            $data[] = [
                'id' => $entity->getId(),
                'value' => DataHelper::getCurrentLangValue($entity->getValue()),
            ];
        }

        if(is_callable($cl)) {
            $cl($data);
        }

        return Json::encode($data, false, ['prettyPrint' => true]);
    }


}