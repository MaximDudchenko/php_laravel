<?php

namespace App\Models;

use App\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
      'path'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function path(): Attribute
    {
        return new Attribute(
            set: fn($image) => FileStorageService::upload($image)
        );
    }

    public function url(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['path'])
        );
    }
}
