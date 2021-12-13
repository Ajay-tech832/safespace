<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class FeedDetailRequest extends FormRequest
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
            'heading'=>'required',
            'sub_heading'=>'required',
            'about'=>'required',
            'goal'=>'required',
            'images' => 'array',
            'images.*' => 'mimes:png,jpeg,jpg,gif|max:1024'
        ];
    }
}
