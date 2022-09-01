<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title' => 'Product title should be more then 5 symbols',
            'description' => 'Product description should be more then 40 symbols',
            'short_description' => 'Product short description should be more then 20 symbols',
            'SKU' => 'Product SKU should be more then 2 symbols',
            'price' => 'Product price not null',
            'discount' => 'Product discount should be between 0, 99',
            'in_stock' => 'Product in stock should be more then 0',
            'category' => 'Product category not null',
            'thumbnail' => 'Product thumbnail should be jpg, png extensions'
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
            'title' => ['required', 'string', 'min:5', 'unique:products'],
            'description' => ['required', 'string', 'min:40'],
            'short_description' => ['required', 'string', 'min:20', 'max:150'],
            'SKU' => ['required', 'string', 'min:2', 'unique:products'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric', 'min:0', 'max:99'],
            'in_stock' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'numeric'],
            'thumbnail' => ['required', 'image:jpeg,jpg,png'],
            'images.*' => ['image:jpeg,jpg,png']
        ];
    }
}
