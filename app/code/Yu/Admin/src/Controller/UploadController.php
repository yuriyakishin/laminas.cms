<?php

namespace Yu\Admin\Controller;

use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;

class UploadController extends AbstractAdminController
{
    public function uploadAction()
    {
        $this->layout()->setTerminal(true);

        $request = $this->getRequest();
        $files   = $request->getFiles();
        if(!empty($files) && !empty($files->toArray()["upload"]))
        {
            $file = $files->toArray()["upload"];
            $imageDir = 'images/uploads/images/'.date('Y-m-d').'/';
            $imageDirAbs = $_SERVER['DOCUMENT_ROOT'] . '/' . $imageDir;
            if(!is_dir($imageDirAbs))
            {
                @mkdir($imageDirAbs,0777,true);
            }
            $imageFile = $imageDir . $file['name'];
            $imageFileAbs = $imageDirAbs . $file['name'];
            move_uploaded_file($file['tmp_name'], $imageFileAbs);
            //
            $result['url'] = '/'.$imageFile;
            $result['uploaded'] = '1';
            $result['fileName'] = $file['name'];

            return new JsonModel($result);
        }
        return 'error';
    }
}