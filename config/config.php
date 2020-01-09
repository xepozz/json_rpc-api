<?php
declare(strict_types=1);


use Phalcon\Logger;

use function Api\root_path;

return [
    'database'    => [
        'adapter'  => getenv('DB_ADAPTER'),
        'host'     => getenv('DB_HOST'),
        'port'     => getenv('DB_PORT'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname'   => getenv('DB_NAME'),
    ],
    'application' => [
        'baseUri'         => getenv('APP_BASE_URI'),
        'publicUrl'       => getenv('APP_PUBLIC_URL'),
        'cryptSalt'       => getenv('APP_CRYPT_SALT'),
        'viewsDir'        => root_path('themes/app/'),
        'cacheDir'        => root_path('var/cache/'),
        'sessionSavePath' => root_path('var/cache/session/'),
    ],
    'logger'      => [
        'path'     => root_path('var/logs/'),
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
];
