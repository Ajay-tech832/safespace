<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class MobileLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'otp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|max:6',
        ];
    }
}
