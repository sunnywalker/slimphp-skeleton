<?php
use App\Controllers\Admin\AuthNController;
use App\Controllers\Admin\HomeAdminController;
use App\Controllers\Admin\UserAdminController;
use App\Middleware\AuthNMiddleware;

$app->get('/admin/log-in', AuthNController::class.':index')->setName('log-in');
$app->post('/admin/log-in', AuthNController::class.':logIn');
$app->get('/admin/log-out', AuthNController::class.':logOut')->setName('log-out');

$app->group('/admin', function () {
    $this->get('/', HomeAdminController::class.':index')->setName('admin-home');

    $this->group('/users', function () {
        $this->get('/', UserAdminController::class.':index')->setName('admin-users');
        $this->post('/', UserAdminController::class.':create');
        $this->get('/{id:[0-9]+}', UserAdminController::class.':edit');
        $this->post('/{id:[0-9]+}', UserAdminController::class.':submit');
    });
})->add(new AuthNMiddleware($container));
