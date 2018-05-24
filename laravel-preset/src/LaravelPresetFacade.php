<?php
namespace Hadefication\LaravelPreset;

use Illuminate\Support\Facades\Facade;

class LaravelPresetFacade extends Facade
{
    /**
     * Get facade accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelPreset';
    }
}
