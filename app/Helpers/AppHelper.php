<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class AppHelper
{
    public static function setActive($route)
    {
        if (is_array($route)) {
            return in_array(Request::path(), $route) ? 'active' : '';
        }
        return Request::path() == $route ? 'active' : '';
    }
}
