<?php

declare(strict_types=1);

use Api\Providers\ConfigProvider;
use Api\Providers\DbProvider;
use Api\Providers\DispatcherProvider;
use Api\Providers\LoggerProvider;
use Api\Providers\RouterProvider;

return [
    ConfigProvider::class,
    DbProvider::class,
    DispatcherProvider::class,
    LoggerProvider::class,
    RouterProvider::class,
];
