<?php

namespace Yu\Eav\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Core\Api\View\Helper\SourceHelperInterface;
use Yu\Eav\Entity\EavValueOption;

class ViewOptionHelper extends AbstractHelper implements SourceHelperInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var $entityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Get value by ID
     * @return string
     */
    public function getContent()
    {
        $criteria = [
            'id' => $this->options['id'],
        ];

        $entity = $this->entityManager->getRepository(EavValueOption::class)->findOneBy($criteria);
        $str = '';
        if(!empty($entity)) {
            $str = $entity->getValue();
        }
        return $str;
    }


    /**
     * @param int $optionId
     * @return mixed
     */
    public function getValuesOption(int $optionId)
    {
        $entities = $this->entityManager->getRepository(EavValueOption::class)->findBy([
            'optionId' => $optionId,
        ], [
            'sort' => 'ASC',
        ]);

        return $entities;
    }

    public function getValue($id)
    {
        $criteria = [
            'id' => $id,
        ];

        $entity = $this->entityManager->getRepository(EavValueOption::class)->findOneBy($criteria);
        $str = '';
        if(!empty($entity)) {
            $str = $entity->getValue();
        }
        return $str;
    }
}