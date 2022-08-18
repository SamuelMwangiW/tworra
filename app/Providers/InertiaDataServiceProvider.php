<?php

namespace App\Providers;

use App\Http\Middleware\ShareInertiaData;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Http\Middleware\ShareInertiaData as JetstreamShareInertiaData;

class InertiaDataServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string,class-string>
     */
    public array $bindings = [
        JetstreamShareInertiaData::class => ShareInertiaData::class,
    ];
}
