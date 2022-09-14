<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && isAdmin(auth()->user());
    }

    public function messages()
    {
        return [
            'name' => 'Product title should be more then 5 symbols',
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
            'name' => ['required', 'string', 'min:5', 'unique:categories'],
            'description' => ['string', 'max:150']
        ];
    }
}
