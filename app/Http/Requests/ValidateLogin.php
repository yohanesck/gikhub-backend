<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLogin extends FormRequest
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
            'nama' => 'required_if:type,google',
            'email' => 'required',
            'password' => 'required_if:type,manual',
            'type' => 'required|in:google,manual',
            'client_id' => 'required_if:type,google'
        ];
    }
}
