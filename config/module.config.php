<?php
return [
    'service_manager' => [
        'invokables' => [
            'Itwapp\Service\Itwapp' => 'Itwapp\Service\Itwapp'
        ],
        'initializers' => [
            'Itwapp\Service\ItwappInitalizer'
        ]
    ]
];