<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DialRequest extends FormRequest
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
        $id = is_null($this->dial) ? NULL : $this->dial->id;
        $rules = [
            'name' => 'required|unique:dials,name,' . $id,
            'status_id' => 'required|exists:statuses,id'
        ];

        return $rules;
    }
}
