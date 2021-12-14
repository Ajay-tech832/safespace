<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class FeedPostRequest extends FormRequest
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
                'description_heading'=>'required',
                'description'=>'required',
                'images'=>'required',
        ];
    }
}
