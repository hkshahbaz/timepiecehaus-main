<?php

namespace App\Http\Requests\Admin;

use App\MoreSetting;
use Illuminate\Foundation\Http\FormRequest;

class MoreSettingRequest extends FormRequest
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
        $id = is_null($this->moreSetting) ? NULL : $this->moreSetting->id;
        $type = $this->get('type');
        $rules = [
            'type' => 'required',
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($id, $type) {
                    if (!is_null($id)) {
                        $count = MoreSetting::whereType($type)->whereName($value)->where('id', '!=', $id)->withTrashed()->count();
                        if ($count) {
                            return $fail($attribute . ' already exist in selected type ');
                        }
                    } else {
                        $count = MoreSetting::whereType($type)->whereName($value)->withTrashed()->count();
                        if ($count) {
                            return $fail($attribute . ' value already exist in selected type ');
                        }
                    }
                    return true;
                }
            ],
            'status_id' => 'required|exists:statuses,id'
        ];

        return $rules;
    }
}
