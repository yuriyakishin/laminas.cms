<?php

namespace Yu\RealtyRentFlat\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Controller\Admin\ValueOptionController;


class ValueOptionClassControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = [
            'option-value' => 'class',
            'title' => 'Класс аренды',
            'route' => 'admin/eav-value-option-class',
        ];

        $tableManager = $container->get('admin.table.manager');
        $tableManager->setConfig(array('eav-value-option' => [
            'options' => [
                'route' => 'admin/eav-value-option-class',
            ],
        ],
        ));

        $formManager = $container->get('admin.form.manager');
        $formManager->setConfig(
            [
                'eav-value-option' => [
                    'action' => 'admin/eav-value-option-class/save',
                    'route-back' => 'admin/eav-value-option-class',
                    'tabs' => [
                        'main' => [
                            'label' => 'Класс аренды',
                        ],
                    ],
                ],
            ]
        );

        return new ValueOptionController($options);
    }

}