<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'code' => 'required|unique:students,code,' .$this->id,
            'name' => 'required',
            'email' => 'required|unique:students,email,' .$this->id,
            'phone' => 'required|unique:students,phone,' .$this->id,
            'address' => 'required',
            'major_id' => 'gt:0',
            'school_year_id' => 'gt:0'
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
            'major_id.gt' => 'Vui lòng chọn ngành học',
            'school_year_id.gt' => 'Vui lòng chọn niên khóa'
        ];
    }
}
