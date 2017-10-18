<?php
$container['view'] = function ($container) {
    $view = new Slim\Views\Twig(__DIR__.'/../views', [
        'cache' => $container->settings['views']['cache'] ?? false,
    ]);
    $base_path = rtrim(str_ireplace('index.php', '', $container->request->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->router, $base_path));
    // app twig extensions
    $view->addExtension(new App\Core\TwigExtension);
    // flash messages
    $view->getEnvironment()->addGlobal('flash_messages', $container->flash->getMessages());
    // current_path
    $view->getEnvironment()->addGlobal('current_path', $container->request->getUri()->getPath());
    // authn
    $view->getEnvironment()->addGlobal('authn', [
        'is_logged_in' => $container->authn->isLoggedIn(),
        'user'         => $container->authn->user(),
    ]);
    return $view;
};
