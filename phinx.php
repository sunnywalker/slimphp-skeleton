<?php
require_once __DIR__.'/app/bootstrap/app.php';
require_once __DIR__.'/app/bootstrap/eloquent.php';

$config = $container['settings']['db']['phinx'];

return [
    'paths' => [
        'migrations' => 'app/database/migrations',
        'seeds' => 'app/database/seeds',
    ],
    'migration_base_class' => 'App\Database\Migrations\Migration',
    'templates' => [
        'file' => 'app/Database/Migrations/MigrationStub.php',
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default' => $config,
    ]
];
