<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImagesStorageServiceContract
{
    public static function attach(Model $model, string $methodName, array $images = []);
}
