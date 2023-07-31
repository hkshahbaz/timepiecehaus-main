<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BraceletMaterialRequest extends FormRequest
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
        $id = is_null($this->brand) ? NULL : $this->brand->id;
        $rules = [
            'name' => 'required|unique:bracelet_materials,name,' . $id,
            'status_id' => 'required|exists:statuses,id'
        ];

//        if (is_null($this->brand)) {
//            $rules['picture'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
//        }
        return $rules;
    }
}
