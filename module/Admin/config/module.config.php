<?php

return [
    'controllers' => [
        'invokables' => [
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
        ],
    ],
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin[/:action][/:verb][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'verb'     => '(list|add|edit|delete){1}',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Admin',
                        'action'     => 'index',
                        'verb'     => 'list',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => [
        'template_path_stack' => [
            'admin' => __DIR__ . '/../view',
        ],
    ],
];

?>