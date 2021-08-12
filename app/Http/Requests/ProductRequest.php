<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'location' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'photos.*' => 'image',
        ];
    }
    public function messages() {

        return [
//            'title.title'=> 'The :attribute is required',
//            'photos.image' => 'image',
        ];
    }
}
