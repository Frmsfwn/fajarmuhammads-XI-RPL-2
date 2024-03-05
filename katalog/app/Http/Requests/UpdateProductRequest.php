<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name'      =>  'required',
            'product_price'     =>  'required',
            'product_link'      =>  'required',
            'product_image'     =>  'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
