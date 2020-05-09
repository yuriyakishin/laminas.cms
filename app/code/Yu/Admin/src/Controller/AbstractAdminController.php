<?php

namespace Yu\Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;

/**
 * Abstract admin controller
 *
 * @method \Doctrine\ORM\EntityManager entityManager()
 * @method \Yu\Media\Service\ImageManager imageManager()
 */

abstract class AbstractAdminController extends AbstractActionController
{
    /**
     * Check user authentication
     * Set admin layout
     *
     * @param MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        $this->authAdmin()->checkUser();

        $this->layout()->setTemplate('admin/layout');
        return parent::onDispatch($e);
    }

}