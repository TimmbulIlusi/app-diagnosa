<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Storage & Cache Handler for Laravel
|--------------------------------------------------------------------------
| Vercel filesystem is read-only. We must redirect storage, sessions,
| views, and bootstrap cache paths to the writable /tmp directory.
*/

$storageDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

putenv('APP_STORAGE=/tmp/storage');
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');
putenv('CACHE_STORE=array');

// Force APP_KEY & APP_DEBUG for Vercel deployment
putenv('APP_KEY=base64:8uA+3A3vH/5x/G7J9X1L3O5Q7R9S1T3U5V7W9X1Y3Z0=');
putenv('APP_DEBUG=true');

$_ENV['APP_STORAGE'] = '/tmp/storage';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['APP_KEY'] = 'base64:8uA+3A3vH/5x/G7J9X1L3O5Q7R9S1T3U5V7W9X1Y3Z0=';
$_ENV['APP_DEBUG'] = 'true';

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Force Laravel instance to use writable storage path
$app->useStoragePath('/tmp/storage');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);