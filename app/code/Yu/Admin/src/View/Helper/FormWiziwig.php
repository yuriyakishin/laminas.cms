<?php


namespace Yu\Admin\View\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormTextarea;

class FormWiziwig extends FormTextarea
{
    public function render(ElementInterface $element)
    {
        return $this->getView()->render('admin/form/element/wiziwig',['element' => $element]);
    }
}