<?php
$container['authn'] = function ($container) {
    return new App\Core\AuthN\AuthN($container['session']);
};
