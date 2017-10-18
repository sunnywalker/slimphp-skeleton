<?php
// App settings
putenv('APP_NAME=App name');
putenv('APP_DEBUG=1');

// Twig settings
putenv('VIEW_CACHE=');

// MySQL settings
putenv('DB_DRIVER=mysql');
// putenv('DB_SOCKET=/tmp/mysql.sock'); // for socket connections
putenv('DB_HOST=localhost'); // for non-socket connections
putenv('DB_PORT=3306'); // for non-socket connections
putenv('DB_DATABASE=');
putenv('DB_USERNAME=root');
putenv('DB_PASSWORD=root');
putenv('DB_CHARSET=utf8mb4');
putenv('DB_COLLATION=utf8mb4_unicode_ci');
putenv('DB_PREFIX=');

// Sqlite settings
// putenv('DB_CONNECTION=sqlite');
// putenv('DB_DATABASE=/absolute/path/to/database.sqlite');

// Redis settings
// putenv('REDIS_SCHEME=tcp');
// putenv('REDIS_HOST=127.0.0.1');
// putenv('REDIS_PORT=6379');
// putenv('REDIS_PASSWORD=');
