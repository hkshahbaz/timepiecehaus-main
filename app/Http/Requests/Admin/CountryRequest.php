<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $id = is_null($this->country) ? NULL : $this->country->id;

        $rules = [
            'name' => 'required|unique:countries,name,' . $id,
            'currency' => 'required',
            'code' => 'required',
            'symbol' => 'required',
            'is_currency_enabled' => 'required',
            'status_id' => 'required|exists:statuses,id'
        ];

        return $rules;
    }
}
