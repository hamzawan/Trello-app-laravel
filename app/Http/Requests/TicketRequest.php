<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class TicketRequest extends FormRequest
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
        if($method == "POST"){
            return [
                "name" => "required",
                "description" => "required",
                "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
                "expire_time" => "required",
                "issue_type" => "required",
                "status" => "required",
                "assignee" => "required",
                "assignor" => "required",
            ];
        }
        return [];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
