<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRequest extends FormRequest
{
    /**
     * Xác định người dùng có được phép thực hiện request này không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Xác định các quy tắc xác thực.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
        ];
    }
}
