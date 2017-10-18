<?php
$app->group('/admin', function () {
    $this->get('/', App\Controllers\HomeAdminController::class.':index')->setName('admin-home');

    $this->group('/users', function () {
        $this->get('/', App\Controllers\UserAdminController::class.':index')->setName('admin-users');
        $this->post('/', App\Controllers\UserAdminController::class.':create');
        $this->get('/{id:[0-9]+}', App\Controllers\UserAdminController::class.':edit');
        $this->post('/{id:[0-9]+}', App\Controllers\UserAdminController::class.':submit');
    });
})->add(new App\Middleware\AuthNMiddleware($container));
