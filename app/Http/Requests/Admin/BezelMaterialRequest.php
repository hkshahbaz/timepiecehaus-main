<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BezelMaterialRequest extends FormRequest
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
        $id = is_null($this->bezelMaterial) ? NULL : $this->bezelMaterial->id;
        $rules = [
            'name' => 'required|unique:bezel_materials,name,' . $id,
            'status_id' => 'required|exists:statuses,id'
        ];

        return $rules;
    }
}
