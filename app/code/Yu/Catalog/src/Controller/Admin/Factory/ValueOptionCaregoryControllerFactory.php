<?php

namespace Yu\Catalog\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Controller\Admin\ValueOptionController;


class ValueOptionCaregoryControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = [
            'option-value' => 'catalog-category',
            'title' => 'Рубрики для объявлений "Купим/Снимем"',
            'route' => 'admin/eav-value-option-catalog-category',
        ];

        $tableManager = $container->get('admin.table.manager');
        $tableManager->setConfig(array('eav-value-option' => [
            'options' => [
                'route' => 'admin/eav-value-option-catalog-category',
            ],
        ],
        ));

        $formManager = $container->get('admin.form.manager');
        $formManager->setConfig(
            [
                'eav-value-option' => [
                    'action' => 'admin/eav-value-option-catalog-category/save',
                    'route-back' => 'admin/eav-value-option-catalog-category',
                    'tabs' => [
                        'main' => [
                            'label' => 'Рубрика',
                        ],
                    ],
                ],
            ]
        );

        return new ValueOptionController($options);
    }

}