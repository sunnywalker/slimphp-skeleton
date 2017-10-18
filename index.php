<?php
// initial setup
require_once 'app/bootstrap/app.php';

// dependencies
require_once 'app/bootstrap/flash.php';
require_once 'app/bootstrap/twig.php';
require_once 'app/bootstrap/eloquent.php';
require_once 'app/bootstrap/authn.php';

// global middleware
// require_once 'app/bootstrap/global-middleware.php';

// routes
require_once 'app/routes/web-public.php';
require_once 'app/routes/web-admin.php';
// require_once 'app/routes/api-1.0.php';

$app->run();
