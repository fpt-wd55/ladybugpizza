<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->rulesForCreate();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->rulesForUpdate();
        }

        return [];
    }

    public function rulesForCreate(): array
    {
        return [
            'title' => 'required',
            'slug' => [
                'required',
                'string',
                'max:20',
                'unique:pages,slug',
                'regex:/^[a-z0-9-]+$/', // Chỉ chấp nhận chữ cái thường, số và dấu gạch ngang
            ],
            'content' => 'required'
        ];
    }


    public function rulesForUpdate(): array
    {
        return [
            'title' => 'required',
            'slug' => [
                'required',
                'string',
                'max:20',
                'regex:/^[a-z0-9-]+$/', // Chỉ chấp nhận chữ cái thường, số và dấu gạch ngang
            ],
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Bạn cần nhập tiêu đề cho trang",
            'slug.required' => "Bạn cần nhập đường dẫn cho trang",
            'slug.max' => "Đường dẫn không quá 20 kí tự",
            'slug.unique' => "Đường dẫn đã tồn tại trong hệ thống",
            'slug.regex' => "Đường dẫn không hợp lệ",
            'content.required' => "Bạn cần mô tả nội dung cho trang"
        ];
    }
}
