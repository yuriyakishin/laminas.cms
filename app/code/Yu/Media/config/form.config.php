<?php

declare(strict_types=1);

namespace Yu\Seo;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'fieldsets' => [
                'images' => [
                    'hydrator' => \Laminas\Hydrator\ClassMethodsHydrator::class,
                    'elements' => [
                        'title' => [
                            'type' => Element\Textarea::class,
                            'name' => 'title',
                            'lang' => true,
                            'options' => [
                                'label' => 'Title',
                                'required' => true,
                            ],
                            'attributes' => [
                                'required' => false,
                                'rows' => 3,
                            ],
                        ],
                    ],
                    'options' => [
                        'template' => 'admin/media/images',
                    ],
                ],
            ],
        ],
    ],
];
