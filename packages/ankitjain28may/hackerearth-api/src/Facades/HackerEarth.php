<?php

namespace Ankitjain28may\HackerEarth\Facades;

use Illuminate\Support\Facades\Facade;

class HackerEarth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hackerearth';
    }
}
