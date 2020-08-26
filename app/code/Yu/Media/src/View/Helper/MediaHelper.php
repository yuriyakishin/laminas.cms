<?php

namespace Yu\Media\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Media\Entity\Image;

class MediaHelper extends AbstractHelper
{
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
     * @param string $path
     * @param int $pathId
     * @param array|null $data
     * @return mixed
     */
    public function getImages(string $path, int $pathId, array $data = null)
    {
        $images = $this->entityManager->getRepository(Image::class)->findBy(['path' => $path, 'pathId' => $pathId],['sort' => 'ASC']);
        return $images;
    }

    public function getPreview(string $path, int $pathId)
    {
        $criteria = [
            'path' => $path,
            'pathId' => $pathId,
            'type' => 'preview',
        ];

        $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);

        if(empty($preview)) {
            $criteria = [
                'path' => $path,
                'pathId' => $pathId,
            ];
            $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);
        }

        return $preview;
    }
}