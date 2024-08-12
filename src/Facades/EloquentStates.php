<?php

namespace Aldoggutierrez\EloquentStates\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Aldoggutierrez\EloquentStates\EloquentStates
 */
class EloquentStates extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Aldoggutierrez\EloquentStates\EloquentStates::class;
    }
}
