<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateCategory extends FormRequest
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
            'name' => 'required|max:255|unique:categories,name',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Category Name is required',
            'name.max'  => 'Category Name must be less that 255 characters',
            'name.unique'=>'Category name is already exists'
        ];
    }
}
