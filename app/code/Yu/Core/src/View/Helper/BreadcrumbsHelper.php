<?php

namespace Yu\Core\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class BreadcrumbsHelper extends AbstractHelper
{
    private $breadcrumbs = [];

    public function setBreadcrumbs(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    public function render()
    {
        return $this->getView()->render('layout/breadcrumbs',['breadcrumbs' => $this->getBreadcrumbs()]);
    }

}