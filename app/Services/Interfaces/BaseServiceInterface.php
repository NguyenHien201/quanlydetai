<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseServiceInterface
{
    public function uploadFile($file, $newFolder = null) :array;
}
