<?php

namespace App\Http\Requests;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ExperienceRequest extends FormRequest
{
    use HttpResponses;
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
            // 'expert_id' => ['required', 'exists:experts,expert_id', 'numeric'],
            'name' => ['required', 'string', 'min:5', 'max:45'],
            'details' => ['required', 'string', 'min:5', 'max:245'],
            'is_private' => ['boolean']
        ];
        if (in_array($this->method(), ["PATCH"])) {
            // $rules['expert_id'] = ['exists:experts,expert_id', 'numeric'];
            $rules['name'] = ['string', 'min:5', 'max:45'];
            $rules['details'] = ['string', 'min:5', 'max:245'];
        }
        return $rules;
    }
}
