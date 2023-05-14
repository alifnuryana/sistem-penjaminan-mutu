<?php

namespace App\Services;

class UtilityService
{
    public function generateNewCode(string $prefix) : string
    {
        return $prefix . '-' . date('Ymd') . '-' . mb_substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 5);
    }
}
