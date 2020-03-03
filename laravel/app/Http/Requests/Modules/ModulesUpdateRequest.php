<?php

namespace App\Http\Requests\Modules;

use Illuminate\Foundation\Http\FormRequest;

class ModulesUpdateRequest extends FormRequest {

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
            'parent_id' => 'required',
            'title' => 'required|unique:modules,title,' . $this->id,
            'path' => 'required',
            'icon' => 'string|nullable'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'parent_id.required' => 'Parent Module field is required!',
            'title.required' => 'Title field is required!',
            'title.unique' => 'This Title has already been taken!',
            'path.required' => 'Path field is required!'
        ];
    }

}
