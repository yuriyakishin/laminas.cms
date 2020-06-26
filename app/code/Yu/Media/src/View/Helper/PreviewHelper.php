<?php

namespace Yu\Media\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Core\Api\View\Helper\SourceHelperInterface;
use Yu\Media\Entity\Image;

class PreviewHelper extends AbstractHelper implements SourceHelperInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var $entityManager
     */
    private $entityManager;

    /**
     * PreviewHelper constructor.
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $criteria = [
            'path' => $this->options['path'],
            'pathId' => $this->options['pathId'],
            'type' => 'preview',
        ];

        $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);

        if(empty($preview)) {
            $criteria = [
                'path' => $this->options['path'],
                'pathId' => $this->options['pathId'],
            ];
            $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);
        }

        $img = '';
        if(!empty($preview)) {
            $img = '<img src="/orig/preview/' . $preview->getImage() . '" />';
        }
        return $img;
    }
}