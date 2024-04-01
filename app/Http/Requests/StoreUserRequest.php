<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|unique:users',
            'password' => 'required|min:6',
            're_password' => 'required|string|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Bạn chưa nhập tên đăng nhập',
            'username.string' => 'tên đăng nhập phải ở dạng ký tự',
            'username.unique' => 'tên đăng nhập đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
            're_password.required' => 'Bạn cần nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu không khớp.',
        ];
    }
}
