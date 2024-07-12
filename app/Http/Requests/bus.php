<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bus extends FormRequest
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
            'bus_name' => ['required', 'string'],
            'model' => ['required','string'],
            'type' => ['required','in:VIP,عادي'],
            'bus_number' => ['required','numeric','unique:bus,bus_number'],
            'form_type' => ['required','in:A,B'],
        ];
    }

    public function messages()
    {
        return [
            'bus_name.required' => 'اسم الحافلة مطلوب',
            'bus_name.string' => 'اسم الحافلة يجب ان يكون نص',
            'model.required' => 'موديل الحافلة مطلوب',
            'model.string' => 'موديل الحافلة يجب ان يكون نص',
            'type.required' => 'نوع الحافلة مطلوب',
            'type.in' => 'نوع الحافلة يجب ان يكون (عادي أو vip)',
            'bus_number.required' => 'رقم الحافلة مطلوب',
            'bus_number.numeric' => 'رقم الحافلة يجب ان يكون رقم',
            'bus_number.unique' => 'رقم الحافلة موجود مسبقاً',
            'bus_number.required' => 'رقم الحافلة مطلوب ',
            'form_type.required' => 'نوع النموذج مطلوب',
        ];
    }
}
