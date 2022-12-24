<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;


class ExpertRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["status" => false, "message" => "Validation Error", "data" => ['errors' => $validator->errors()]], 422));
    }
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:45'],
            'category_id' => ['required', 'numeric', 'exists:categories,category_id'],
            'pic' => ['file', 'image', 'dimensions:min_width=100,min_height=100'],
            'phone' => ['required', 'string', 'min:7', 'max:45', 'unique:experts'],
            'address' => ['required', 'string', 'min:5', 'max:45'],
            'openning_time' => ['required', 'string', 'max:245'],
            'email' => ['required', 'email', 'unique:experts,email', 'max:245'],
            'password' => ['required', 'min:8', 'max:45'],
            'balance' => ['required', 'numeric']
        ];
        if (in_array($this->method(), ["PATCH"])) {
            $rules = [
                'name' => ['string', 'min:5', 'max:45'],
                'category_id' => ['numeric', 'exists:categories,category_id'],
                'pic' => ['file', 'image', 'dimensions:min_width=100,min_height=100'],
                'phone' => ['string', 'min:7', 'max:45', Rule::unique('experts', 'phone')->ignore($this->expert_id, 'expert_id')],
                'address' => ['string', 'min:5', 'max:45'],
                'openning_time' => ['string', 'max:245'],
                'email' => ['email', Rule::unique('experts', 'email')->ignore($this->expert_id, 'expert_id'), 'max:245'],
                'password' => ['min:8', 'max:45'],
                'balance' => ['numeric']
            ];
        }
        return $rules;
    }
}
