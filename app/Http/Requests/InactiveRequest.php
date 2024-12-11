<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InactiveRequest extends FormRequest
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
        'email' => [
            'required',
            'email',
            Rule::exists('users')->where(function ($query) {
                $query->where('email', request('email'));
            }),
        ],
    ];
}

public function messages(): array
{
    return [
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Email không đúng định dạng. Vui lòng nhập đúng định dạng email.',
        'email.exists' => 'Email này không tồn tại trong hệ thống.',
    ];
}


    
}
