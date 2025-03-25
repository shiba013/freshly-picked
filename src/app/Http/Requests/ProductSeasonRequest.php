<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSeasonRequest extends FormRequest
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
        return array_merge (
            (new ProductRequest())->rules(),
            (new SeasonRequest())->rules(),
        );
    }

    public function messages()
    {
        return array_merge (
            (new ProductRequest())->messages(),
            (new SeasonRequest())->messages(),
        );
    }
}
