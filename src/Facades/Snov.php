<?php

namespace HelgeSverre\Snov\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HelgeSverre\Snov\Snov
 */
class Snov extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HelgeSverre\Snov\Snov::class;
    }
}
