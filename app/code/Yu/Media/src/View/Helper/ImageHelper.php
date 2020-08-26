<?php

namespace Yu\Media\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Media\Service\ImageManager;
use Yu\Media\Entity\Image;

class ImageHelper extends AbstractHelper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var \Yu\Media\Entity\Image
     */
    private $imageEntity;

    /**
     * @var bool
     */
    private $flagFull = true;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $imageOrig = '';

    /**
     * @var string
     */
    private $dirOrig = '';

    /**
     * @var string
     */
    private $imageName = '';

    /**
     * @var bool
     */
    private $emptyImageFlag = false;

    /**
     * ImageHelper constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param ImageManager $imageManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager,
        ImageManager $imageManager
    )
    {
        $this->entityManager = $entityManager;
        $this->imageManager = $imageManager;
    }

    /**
     * @return $this
     */
    public function full()
    {
        $this->flagFull = true;
        $this->width = null;
        $this->height = null;

        return $this;
    }

    /**
     * @param null $width
     * @param null $height
     * @return $this
     */
    public function resize($width = null, $height = null)
    {
        if (!empty($width) || !empty($height)) {
            $this->flagFull = false;
            $this->width = $width;
            $this->height = $height;
        }
        return $this;
    }

    public function crop($width, $height)
    {
        if (!empty($width) || !empty($height)) {
            $this->flagFull = false;
            $this->width = $width;
            $this->height = $height;
        }
        return $this;
    }

    /**
     * @param string $imageOrig
     * @return $this
     */
    public function orig(string $imageOrig)
    {
        $this->imageOrig = $imageOrig;
        return $this;
    }

    /**
     * @param string $path
     * @param int $pathId
     * @param string|null $type
     * @return $this
     */
    public function load(string $path, int $pathId, string $type = null)
    {
        /*
        $criteria = [
            'path' => $path,
            'pathId' => $pathId,
        ];
        if(!empty($type)) {
            $criteria['type'] = $type;
        }

        $imageEntity = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);*/

        $imageEntity = $this->getPreview($path, $pathId);
        $this->imageEntity = $imageEntity;
        if ($imageEntity) {
            $this->imageOrig = $imageEntity->getImage();
            $this->dirOrig = $imageEntity->getImageDir();
            $this->imageName = $imageEntity->getImageName();
        } else {
            $this->setEmptyImage();
        }

        return $this;
    }

    /**
     * @param $imageEntity
     * @return $this
     */
    public function setImageEntity($imageEntity)
    {
        $this->imageEntity = $imageEntity;
        $this->imageOrig = $imageEntity->getImage();
        $this->dirOrig = $imageEntity->getImageDir();
        $this->imageName = $imageEntity->getImageName();

        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image)
    {
        $arr = explode('/', $image);
        $count = count($arr);
        $this->imageName = $arr[$count - 1];
        $this->imageOrig = $image;
        $this->dirOrig = str_replace($this->imageName, $image, '');

        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setEmptyImage()
    {
        $this->setImage('images/not-found.jpg');
        $this->emptyImageFlag = true;

        return $this;
    }

    private function getPreview(string $path, int $pathId)
    {
        $criteria = [
            'path' => $path,
            'pathId' => $pathId,
            'type' => 'preview',
        ];

        $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);

        if (empty($preview)) {
            $criteria = [
                'path' => $path,
                'pathId' => $pathId,
            ];
            $preview = $this->entityManager->getRepository(Image::class)->findOneBy($criteria, ['sort' => 'ASC']);
        }

        return $preview;
    }

    public function get()
    {
        if (empty($this->imageOrig)) {
            return null;
        }

        if ($this->flagFull) {
            return '/orig/' . $this->imageOrig;
        }

        $width = $this->width ? $this->width : 0;
        $height = $this->height ? $this->height : 0;

        $pubDir = '/pub/images/' . (string)$width . 'x' . (string)$height . '/' . $this->dirOrig;

        $pubDirAbsolutely = $_SERVER['DOCUMENT_ROOT'] . '' . $pubDir;
        $pubImage = $pubDir . '/' . $this->imageName;
        $pubImageAbsolutely = $pubDirAbsolutely . '/' . $this->imageName;

        $originalImageAbsolutely = $_SERVER['DOCUMENT_ROOT'] . '/orig/' . $this->imageOrig;

        if (!is_dir($pubDirAbsolutely)) {
            mkdir($pubDirAbsolutely, 0777, true);
        }

        if (!is_file($pubImageAbsolutely) && is_file($originalImageAbsolutely)) {
            $image = $this->imageManager->open($originalImageAbsolutely);

            // маштабируем по ширине
            if ($width > 0 && $height == 0) {
                $widthOriginal = $image->width();
                $heightOriginal = $image->height();
                $height = ($width * $heightOriginal) / $widthOriginal;
            }

            // маштабируем по высоте
            if ($width == 0 && $height > 0) {
                $widthOriginal = $image->width();
                $heightOriginal = $image->height();
                $width = ($height * $widthOriginal) / $heightOriginal;
            }

            $image->resize($width, $height);
            $image->save($pubImageAbsolutely, 100);
        }

        //
        if (is_file($pubImageAbsolutely)) {
            return $pubImage;
        }



        return '';
    }
}