<?php

namespace Yu\RealtySaleCommercial\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Controller\Admin\ValueOptionController;

class ValueOptionCommercialControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = [
            'option-value' => 'commercial',
            'title' => 'Коммерческая недвижимость',
            'route' => 'admin/eav-value-option-commercial',
        ];

        $tableManager = $container->get('admin.table.manager');
        $tableManager->setConfig(array('eav-value-option' => [
            'options' => [
                'route' => 'admin/eav-value-option-commercial',
            ],
        ],
        ));

        $formManager = $container->get('admin.form.manager');
        $formManager->setConfig(
            [
                'eav-value-option' => [
                    'action' => 'admin/eav-value-option-commercial/save',
                    'route-back' => 'admin/eav-value-option-commercial',
                    'tabs' => [
                        'main' => [
                            'label' => 'Коммерческая недвижимость',
                        ],
                    ],
                ],
            ]
        );

        return new ValueOptionController($options);
    }
}