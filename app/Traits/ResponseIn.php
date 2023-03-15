<?php

namespace App\Traits;

trait ResponseIn
{
    public function resourceAkm($data)
    {
        $result = response()->json($data);
        return $result;
    }
}
