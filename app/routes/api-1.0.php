<?php
$app->group('/api/1.0', function () {
    $this->get('/', App\Controllers\Api\ApiController::class.':index')->setName('api');
});
