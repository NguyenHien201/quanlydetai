<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|unique:users,username,' .$this->id, 
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Bạn chưa nhập họ tên',
            'username.string' => 'Họ tên phải ở dạng ký tự',
            'username.unique' => 'tên đăng nhập đã tồn tại',
            // 'password.required' => 'Bạn chưa nhập mật khẩu',
            // 'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
        ];
    }
}
