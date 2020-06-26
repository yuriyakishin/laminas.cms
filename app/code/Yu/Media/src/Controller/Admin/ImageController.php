<?php

namespace Yu\Media\Controller\Admin;

use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Yu\Admin\Controller\AbstractAdminController;
use Yu\Media\Entity\Image;

class ImageController extends AbstractAdminController
{
    public function indexAction()
    {
        $path = $this->params()->fromQuery('path');
        $pathId = $this->params()->fromQuery('path_id');
        $images = $this->entityManager()->getRepository(Image::class)->findBy(['path' => $path, 'pathId' => $pathId],['sort' => 'ASC']);

        $data = array();
        foreach($images as $image)
        {
            $data[] = [
                'id' => $image->getId(),
                'img' => '<img src="/orig/preview/'.$image->getImage().'" class="file-preview-image" />',
                'preview' => '<img src="/orig/preview/'.$image->getImage().'" height="50" class="file-preview-image" />',
                'sort' => $image->getSort(),
                'type' => $image->getType(),
                'comment' => $image->getComment(),
            ];
        }

        return new JsonModel($data);
    }

    public function uploadAction()
    {
        if ($this->getRequest()->isPost()) {
            $dataPost = $this->params()->fromPost();

            if ( !empty( $_FILES ) )
            {
                $path = $this->params()->fromPost('path' );
                $pathId = $this->params()->fromPost('path_id' );

                $dir = 'images' . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . substr(md5(time()), 0, 8);
                $dirAbsolutely = $_SERVER['DOCUMENT_ROOT'].'/orig/'.$dir;
                if(!is_dir($dirAbsolutely))
                {
                    @mkdir($dirAbsolutely,0777,true);
                }

                $dirAbsolutelyPreview = $_SERVER['DOCUMENT_ROOT'].'/orig/preview/'.$dir;
                if(!is_dir($dirAbsolutelyPreview))
                {
                    @mkdir($dirAbsolutelyPreview,0777,true);
                }

                $tempPath = $_FILES[ 'images' ][ 'tmp_name' ];
                $file = $_FILES[ 'images' ][ 'name' ];
                $size = $_FILES[ 'images' ][ 'size' ];
                $uploadPath = $dirAbsolutely . '/' . $file;
                $img = $dir.'/'.$file;

                move_uploaded_file( $tempPath, $uploadPath );

                $imageManager = $this->imageManager();

                $imageManager->open($_SERVER['DOCUMENT_ROOT'].'/orig/'.$img);
                $imageManager->resize(50,50)->save($dirAbsolutelyPreview.'/'.$file);

                $image = new Image();
                $image->setUserId($this->authAdmin()->getCurrentUser()->getSiteId());
                $image->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                $image->setPathId($pathId);
                $image->setPath($path);
                $image->setSort(100);
                $image->setTemp(1);
                $image->setActive(1);
                $image->setComment('');
                $image->setType('');
                $image->setImage($img);
                $image->setImageName($file);
                $image->setImageDir($dir);
                $image->setImageSize($size);
                $image->setImageWidth($imageManager->width());
                $image->setImageHeight($imageManager->height());
                $id = $this->entityManager()->getRepository(Image::class)->save($image);


                $answer = array(
                    'img' => '<img src="/orig/'.$img.'" class="file-preview-image" />',
                    'preview' => '<img src="/orig/preview/'.$img.'" height="50" class="file-preview-image" />',
                    'append' => 'true',
                    'result' => 'OK',
                    'id' => $id,
                    'dir' => $dir,
                    'sort' => 100,
                    'file' => $file,
                    'answer' => 'File transfer completed' );

                return new JsonModel($answer);
            }


        }

        return $this->getResponse();
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Image::class)->findOneById($id);
            //
            if(is_file($_SERVER['DOCUMENT_ROOT'].'/orig/' . $entity->getImage())) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/orig/' . $entity->getImage());
            }

            if(is_file($_SERVER['DOCUMENT_ROOT'].'/orig/preview/' . $entity->getImage())) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/orig/preview/' . $entity->getImage());
            }

            $this->entityManager()->getRepository(Image::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }


}