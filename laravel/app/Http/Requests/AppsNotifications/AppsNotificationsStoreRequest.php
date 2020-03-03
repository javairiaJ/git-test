<?php

namespace App\Http\Requests\AppsNotifications;

use Illuminate\Foundation\Http\FormRequest;

class AppsNotificationsStoreRequest extends FormRequest {

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
            'device_type_id' => 'required',
            'app_type_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'version' => 'required|string',
            'time_period' => 'required|integer',
            'action' => 'required',
            'status' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'device_type_id.required' => 'Device Type field is required!',
            'app_type_id.required' => 'App Type field is required!',
            'title.required' => 'Title field is required!',
            'description.required' => 'Description field is required!',
            'version.required' => 'Version field is required!',
            'time_period.unique' => 'Time Period field is required!',
            'action.required' => 'Action field is required!',
            'status.required' => 'Status field is required!'
        ];
    }

}
