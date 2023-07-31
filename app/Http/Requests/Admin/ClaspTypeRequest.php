<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClaspTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->hasRole('admin'))
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = is_null($this->claspType) ? NULL : $this->claspType->id;
        $rules = [
            'name' => 'required|unique:clasp_types,name,' . $id,
            'status_id' => 'required|exists:statuses,id'
        ];

        return $rules;
    }
}
