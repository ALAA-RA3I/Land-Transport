<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class trip extends FormRequest
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
            'date' => ['required','date' ,'after_or_equal:today'],
            'start_trip' => ['required'],
            'end_trip' => ['required' , 'after:start-trip'],
            'cost' => ['required' , 'numeric', 'min:500'],
            // 'Driver_id'=>['required' , 'exists:driver,id'],
            'Bus_id'=>['required' , 'exists:bus,id'],
            'From_To_id'=>['required' , 'exists:from_to,id'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'حقل تاريخ الرحلة مطلوب',
            'date.date' => 'يجب أن يكون الحقل تاريخاً صالحاً',
            'date.after_or_equal' => 'يجب أن يكون تاريخ الرحلة في المستقبل أو اليوم الحالي',
            'start-trip.required' => 'وقت انطلاق الرحلة مطلوب',
            'start-trip.date_format' => 'وقت انطلاق الرحلة يجب ان يكون من النمط ساعة:دقيقة',
            'end-trip.required' => 'وقت وصول الرحلة مطلوب',
            'end-trip.date_format' => 'وقت وصول الرحلة يجب ان يكون من النمط ساعة:دقيقة',
            'cost.required' => ' ثمن الرحلة مطلوب',
            'cost.numeric' => ' ثمن الرحلة يجب ان يكون رقم',
            'cost.min' => ' ثمن الرحلة يجب ان يكون على الأقل 500',
            'Driver_id.required' => 'حقل اختيار السائق مطلوب',
            // 'Driver_id.exists' => 'السائق الذي تحاول اختياره غير مسجل في النظام',
            'Bus_id.required' => 'حقل اختيار الحافلة مطلوب',
            'Bus_id.exists' => 'الحافلة التي تحاول اختيارها غير مسجلة في النظام',
            'From_To_id.required' => 'حقل اختيار الوجهة مطلوب',
            'From_To_id.exists' => 'الوجهة التي تحاول اختيارها غير مسجلة في النظام',
        ];
    }
}
