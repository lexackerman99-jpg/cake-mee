<?php

$tmp = '/tmp/storage';
foreach (['framework/views', 'framework/cache', 'framework/sessions', 'logs'] as $d) {
    if (!is_dir("$tmp/$d")) {
        mkdir("$tmp/$d", 0755, true);
    }
}
if (!is_dir('/tmp/bootstrap-cache')) {
    mkdir('/tmp/bootstrap-cache', 0755, true);
}

$env = [
    'LARAVEL_STORAGE_PATH'   => $tmp,
    'VIEW_COMPILED_PATH'     => "$tmp/framework/views",
    'APP_SERVICES_CACHE'     => '/tmp/bootstrap-cache/services.php',
    'APP_PACKAGES_CACHE'     => '/tmp/bootstrap-cache/packages.php',
    'APP_CONFIG_CACHE'       => '/tmp/bootstrap-cache/config.php',
    'APP_ROUTES_CACHE'       => '/tmp/bootstrap-cache/routes.php',
    'APP_EVENTS_CACHE'       => '/tmp/bootstrap-cache/events.php',
];
foreach ($env as $k => $v) {
    putenv("$k=$v");
    $_ENV[$k] = $v;
    $_SERVER[$k] = $v;
}

require __DIR__ . '/../public/index.php';