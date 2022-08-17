<?php


use App\Helpers\Enums\Roles;
use App\Models\User;

if (!function_exists('isAdmin')) {
    function isAdmin(User $user): bool
    {
        return $user->role->name === Roles::Admin->value;
    }
}
