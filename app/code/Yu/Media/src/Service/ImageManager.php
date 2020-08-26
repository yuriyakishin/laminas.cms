<?php

namespace Yu\Media\Service;

use Intervention\Image\ImageManager as InterventionImageManager;

class ImageManager
{
    /**
     * @var InterventionImageManager
     */
    private $imageManager;

    /**
     * @var \Intervention\Image\Image
     */
    private $image;

    public function __construct()
    {
        $this->imageManager = new InterventionImageManager();
    }

    /**
     * @param string $path
     * @return $this
     */
    public function open(string $path)
    {
        $manager = new InterventionImageManager();
        $image = $this->imageManager->make($path);
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function width()
    {
        return $this->image->width();
    }

    /**
     * @return int
     */
    public function height()
    {
        return $this->image->height();
    }

    /**
     * @param int|null $width
     * @param int|null $height
     * @param \Closure|null $callback
     * @return \Intervention\Image\Image
     */
    public function resize(int $width = null, int $height = null, \Closure $callback = null)
    {
        return $this->image->fit($width, $height, $callback);
    }

    /**
     * @param null $path
     * @param null $quality
     * @param null $format
     * @return \Intervention\Image\Image
     */
    public function save($path = null, $quality = null, $format = null)
    {
        return $this->image->save($path, $quality, $format);
    }

    /**
     * @param \Yu\Media\Entity\Image $preview
     */
    public function makePreview($preview)
    {
        if($preview) {
            if (!is_file($_SERVER['DOCUMENT_ROOT'] . '/orig/preview/' . $preview->getImage()) && is_file($_SERVER['DOCUMENT_ROOT'] . '/orig/' . $preview->getImage())) {
                if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/orig/preview/' . $preview->getImageDir())) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/orig/preview/' . $preview->getImageDir(), 0755, true);
                }
                $this->open($_SERVER['DOCUMENT_ROOT'] . '/orig/' . $preview->getImage());
                $this->resize(50, 50)->save($_SERVER['DOCUMENT_ROOT'] . '/orig/preview/' . $preview->getImage());
            }
        }
    }

}