<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLecturerRequest extends FormRequest
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
            'code' => 'required|unique:lecturers,code,' .$this->id,
            'name' => 'required',
            'email' => 'required|unique:lecturers,email,' .$this->id,
            'phone' => 'required|unique:lecturers,phone,' .$this->id,
            'address' => 'required',
            'position_id' => 'gt:0',
            'department_id' => 'gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Bạn chưa nhập mã giảng viên',
            'code.unique' => 'Mã giảng viên đã tồn tại',
            'name.required' => 'Bạn chưa nhập tên giảng viên',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'position_id.gt' => 'Vui lòng chọn chức vụ',
            'department_id.gt' => 'Vui lòng chọn khoa'
        ];
    }
}
