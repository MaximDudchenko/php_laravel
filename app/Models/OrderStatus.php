<?php

namespace App\Models;

use App\Helpers\Enums\OrderStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeDefaultStatus($query)
    {
        return $query->where('name', OrderStatuses::InProcess->value);
    }

    public function scopePaidStatus($query)
    {
        return $query->where('name', OrderStatuses::Paid->value);
    }
}