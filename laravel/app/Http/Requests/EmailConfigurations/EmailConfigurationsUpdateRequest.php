<?php

namespace App\Http\Requests\EmailConfigurations;

use Illuminate\Foundation\Http\FormRequest;

class EmailConfigurationsUpdateRequest extends FormRequest {

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
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required|email|max:250|unique:email_configurations,username,' . $this->id,
            'password' => 'required',
            'encryption' => 'required',
            'from_name' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'driver.required' => 'Driver field is required!',
            'host.required' => 'Host field is required!',
            'port.required' => 'Port field is required!',
            'username.required' => 'Username field is required!',
            'password.required' => 'Password field is required!',
            'encryption.required' => 'Encryption field is required!',
            'from_name.required' => 'From Name field is required!'
        ];
    }

}
