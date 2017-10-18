<?php
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']['eloquent']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};
