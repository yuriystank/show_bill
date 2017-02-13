<?php

$config = [
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'default/index',
            ],
        ],
    ],
    'defaultRoute' => 'admin',
];

return $config;
