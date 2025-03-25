<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required| accepted',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '季節を選択してください',
            'id.accepted' => '季節を選択してください',
        ];
    }
}
