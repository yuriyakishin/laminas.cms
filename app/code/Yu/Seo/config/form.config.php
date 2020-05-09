<?php

declare(strict_types=1);

namespace Yu\Seo;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'fieldsets' => [
                'meta' => [
                    'object' => \Yu\Seo\Entity\Meta::class,
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
                        'description' => [
                            'type' => Element\Textarea::class,
                            'name' => 'description',
                            'lang' => true,
                            'options' => [
                                'label' => 'Description',
                                'required' => false,
                            ],
                            'attributes' => [
                                'required' => false,
                                'rows' => 3,
                            ],
                        ],
                        'keywords' => [
                            'type' => Element\Textarea::class,
                            'name' => 'keywords',
                            'lang' => true,
                            'options' => [
                                'label' => 'Keywords',
                                'required' => false,
                            ],
                            'attributes' => [
                                'required' => false,
                                'rows' => 3,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
