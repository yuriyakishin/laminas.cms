<?php

namespace Yu\Geo\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Controller\Admin\ValueOptionController;

class ValueOptionDistrictControllerFactory
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = [
            'option-value' => 'district',
            'title' => 'Районы города',
            'route' => 'admin/eav-value-option-district',
        ];

        $tableManager = $container->get('admin.table.manager');
        $tableManager->setConfig(array('eav-value-option' => [
            'options' => [
                'route' => 'admin/eav-value-option-district',
            ],
        ],
        ));

        $formManager = $container->get('admin.form.manager');
        $formManager->setConfig(
            [
                'eav-value-option' => [
                    'action' => 'admin/eav-value-option-district/save',
                    'route-back' => 'admin/eav-value-option-district',
                    'tabs' => [
                        'main' => [
                            'label' => 'Районы города',
                        ],
                    ],
                ],
            ]
        );

        return new ValueOptionController($options);
    }
}