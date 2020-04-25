<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaRequest extends FormRequest
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
            'matrix_id' => 'required|numeric',
            'name' => 'required',
            'weight' => 'required|numeric',
        ];
    }
}
