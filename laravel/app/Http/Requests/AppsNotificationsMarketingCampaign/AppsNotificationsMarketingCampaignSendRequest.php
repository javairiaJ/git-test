<?php

namespace App\Http\Requests\AppsNotificationsMarketingCampaign;

use Illuminate\Foundation\Http\FormRequest;

class AppsNotificationsMarketingCampaignSendRequest extends FormRequest {

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
            'title' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'title.required' => 'Title field is required!',
            'description.required' => 'Description field is required!',
        ];
    }

}
