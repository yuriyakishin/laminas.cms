<?php

namespace Yu\RealtySaleFlat\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Controller\Admin\ValueOptionController;

class ValueOptionProjectControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = [
            'option-value' => 'project',
            'title' => 'Проекты домов',
            'route' => 'admin/eav-value-option-project',
        ];

        $tableManager = $container->get('admin.table.manager');
        $tableManager->setConfig(array('eav-value-option' => [
            'options' => [
                'route' => 'admin/eav-value-option-project',
            ],
        ],
        ));

        $formManager = $container->get('admin.form.manager');
        $formManager->setConfig(
            [
                'eav-value-option' => [
                    'action' => 'admin/eav-value-option-project/save',
                    'route-back' => 'admin/eav-value-option-project',
                    'tabs' => [
                        'main' => [
                            'label' => 'Проекты домов',
                        ],
                    ],
                ],
            ]
        );

        return new ValueOptionController($options);
    }
}