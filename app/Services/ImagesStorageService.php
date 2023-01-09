<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class ImagesStorageService implements Contracts\ImagesStorageServiceContract
{

    public static function attach(Model $model, string $methodName, array $images = [])
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception($model::class . "doesn't have {$methodName}");
        }

        foreach ($images as $image) {
            call_user_func([$model, $methodName])->create(['path' => $image]);
        }
    }
}
