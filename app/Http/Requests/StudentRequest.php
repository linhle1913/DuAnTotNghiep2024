<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'gender' => 'required',
            'class_id' => 'required',
            'tel' => [
                'required',
                Rule::unique('students')->ignore($this->route('id')),  // Sử dụng 'id' thay vì 'student'
            ],
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'gender.required' => 'Giới tính là bắt buộc.',
            'class_id.required' => 'lớp là bắt buộc.',
            'tel.required' => 'Số điện thoại là bắt buộc.',
            'tel.unique' => 'Số điện thoại này đã được sử dụng.',
            'address.required' => 'Địa chỉ là bắt buộc.',
        ];
    }
}
