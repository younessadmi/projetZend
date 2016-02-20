<?php

return [
    'controllers' => [
        'invokables' => [
            'Article\Controller\Article' => 'Article\Controller\ArticleController',
        ],
    ],
    'router' => array(
        'routes' => array(
            'article' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/article[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Article\Controller\Article',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => [
        'template_path_stack' => [
            'article' => __DIR__ . '/../view',
        ],
    ],
];

?>