<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
        $method = $this->method();
        if ($method == "POST"){
            return [
                "email" => "required|email|unique:users",
                "full_name" => "required",
                "username" => "required|unique:users",
                "password" => "required|min:6",
                "confirm_password" => "required|min:6|same:password",
            ];
        }
        return [
            "email" => "email|unique:users",
            "username" => "unique:users",
            "password" => "min:6",
            "confirm_password" => "min:6|same:password",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}