<?php

namespace App\Http\Requests\Auth;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name:min' => 'User name should be more then 2 symbols',
            'surname:min' => 'User name should be more then 2 symbols',
            'phone' => 'Incorrect phone format',
            'password' => 'Incorrect password'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:35'],
            'surname' => ['required', 'string', 'min:2', 'max:50'],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
            'phone' => ['required', 'string', 'max:15', 'unique:users', new Phone],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
