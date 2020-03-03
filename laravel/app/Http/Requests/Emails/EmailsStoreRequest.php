<?php

namespace App\Http\Requests\Emails;

use Illuminate\Foundation\Http\FormRequest;

class EmailsStoreRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'user_id' => 'required',
            'email' => 'required|email|max:50|unique:emails'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'email.required' => 'Email field is required!'
        ];
    }

}
