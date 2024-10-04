<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            
            
        ];
    }

    public function messages(): array
    {
        return [
        'name.required' => 'Tên sản danh mục là bắt buộc.',
        'name.string' => 'Yêu cầu giá trị của name phải là một chuỗi',
        'name.max' => 'Tên danh mục tối đa 255 ký tự.',
       
        'slug.required' => 'Slug là bắt buộc.',
        'slug.string' => 'Yêu cầu giá trị của slug phải là một chuỗi',
        'slug.max' => 'Slug tối đa 255 ký tự.',
     
        ];
    }
}
