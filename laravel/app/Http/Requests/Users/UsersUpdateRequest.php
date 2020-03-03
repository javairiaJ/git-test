<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest {

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
            'role_id' => 'required',
            'designation' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|max:50|unique:users,email,' . $this->id
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'role_id.required' => 'Role field is required!',
            'designation.required' => 'Designation field is required!',
            'firstName.required' => 'First Name field is required!',
            'lastName.unique' => 'Last Name field is required!',
            'email.required' => 'Email field is required!'
        ];
    }

}
