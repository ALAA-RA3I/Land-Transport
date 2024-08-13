<?php

namespace App\Http\Requests;

use App\Rules\DriverEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
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
            'Fname' => ['required', 'string'],
            'Lname' => ['required', 'string'],
            'email' => ['required','email',Rule::unique('driver')->ignore($this->route('id')),new DriverEmail()],
            'password' => ['required', 'min:8','max:20'],
            'phone_number' => ['required', 'numeric'],
            'year_experince'=>['required', 'numeric'],
            'birthday' => ['required'],
            'hire_date' => ['required'],

        ];

    }
    public function messages()
    {
        return [
            'Fname.required' => 'اسم السائق الاول مطلوب',
            'Fname.string' => 'اسم السائق الاول يجب ان يكون نص',
            'Lname.required' => 'اسم السائق الاخير مطلوب',
            'Lname.string' => 'اسم السائق الاخير يجب ان يكون نص',
            'email.required' => 'الايميل مطلوب',
            'email.email' => 'الايميل يجب ان يحتوي @',
            'email.unique' => 'الايميل موجود مسبقاً الرجاء اختيار ايميل اخر',
            'password.required' => 'كلمة السر مطلوب',
            'password.min' => 'كلمة السر يجب ان لا تقل عن 8 محارف',
            'password.max' => 'كلمة السر يجب ان لا تكون اكثر من 20 محرف',
            'phone_number.required' => 'إدخال رقم الموبايل مطلوب',
            'phone_number.numeric' => ' رقم الموبايل يجب ان يكون ارقام فقط',
            'year_experince.required' => 'إدخال عدد سنوات الخبرة مطلوب',
            'year_experince.numeric' => ' عدد سنوات الخبرة جب ان يكون رقم',
            'birthday.required' => 'ادخال تاريخ مطلوب ',
            'hire_date.required' => 'ادخال تاريخ التوظيف مطلوب'
        ];
    }
}
