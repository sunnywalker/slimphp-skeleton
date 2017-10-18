<?php
session_start();

require_once __DIR__.'/../vendor/autoload.php';
if (!is_readable(__DIR__.'/../../env.php')) {
    echo 'No environment settings found.';
    exit;
}
require_once __DIR__.'/../../env.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => !!getenv('APP_DEBUG'),

        'app' => [
            'name' => getenv('APP_NAME')
        ],

        'views' => [
            'cache' => getenv('VIEW_CACHE') != '' ? getenv('VIEW_CACHE') : false
        ],

        'db' => [
            'eloquent' => [
                'driver'    => getenv('DB_DRIVER'),
                'host'      => getenv('DB_HOST'),
                'port'      => getenv('DB_PORT'),
                // 'unix_socket' => getenv('DB_SOCKET'),
                'database'  => getenv('DB_DATABASE'),
                'username'  => getenv('DB_USERNAME'),
                'password'  => getenv('DB_PASSWORD'),
                'charset'   => getenv('DB_CHARSET'),
                'collation' => getenv('DB_COLLATION'),
                'prefix'    => '',
            ],
            'phinx' => [
                'adapter' => getenv('DB_DRIVER'),
                'host'    => getenv('DB_HOST'),
                'port'    => getenv('DB_PORT'),
                // 'unix_socket' => getenv('DB_SOCKET'),
                'name'    => getenv('DB_DATABASE'),
                'user'    => getenv('DB_USERNAME'),
                'pass'    => getenv('DB_PASSWORD'),
                'charset' => getenv('DB_CHARSET'),
            ]
        ]
    ],
]);

$container = $app->getContainer();
