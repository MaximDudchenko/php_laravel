<?php


use App\Helpers\Enums\Roles;
use App\Models\Product;
use App\Models\User;

if (!function_exists('isAdmin')) {
    function isAdmin(User $user): bool
    {
        return $user->role->name === Roles::Admin->value;
    }
}

if (!function_exists('is_user_followed')) {
    function is_user_followed(Product $product):bool
    {
        return (bool)auth()->user()->wishes()->find($product->id);
    }
}
