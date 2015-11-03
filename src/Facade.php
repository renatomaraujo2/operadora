<?php

namespace Renatomaraujo2\Operadora;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * Class Facade
 * @package Renatomaraujo2\Operadora
 */
class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'operadora';
    }
}