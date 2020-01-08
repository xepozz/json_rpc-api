<?php

declare(strict_types=1);

use Rpc\Providers\ConfigProvider;
use Rpc\Providers\DbProvider;
use Rpc\Providers\DispatcherProvider;
use Rpc\Providers\LoggerProvider;
use Rpc\Providers\RouterProvider;

return [
    ConfigProvider::class,
    DbProvider::class,
    DispatcherProvider::class,
    LoggerProvider::class,
    RouterProvider::class,
];
