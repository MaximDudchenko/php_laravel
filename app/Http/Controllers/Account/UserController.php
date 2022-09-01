<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('accounts/index', ['user' => auth()->user()]);
    }

    public function edit(User $user)
    {
        return view('accounts/user/edit', compact('user'));
    }

    public function update(UserAccountRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect(route('account.index'))->with('success', 'User data was updated!');
    }
}
