<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CurriculumRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lrn' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'track' => 'required',
            'curriculum_exit' => 'required',
            'section' => 'required',
            'emmersion_company' => 'max:255',
            'employment_status' => 'required|in:1,2',
            'address'   => 'required',
        ];
    }

    public function messages()
    {

        $messages = ['address.required' => 'Please State what country.'];

        $employment_status = $this->input('employment_status');

        if($employment_status == 1){
            $messages['address.required'] = "Please State what company1.";
        }

        return $messages;
    }
}
