<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
            $rules = [
                'name' => "required|unique:roles,name",
            ];

            if($this->route('role')) {
                $role = Product::find($this->route('product'))->first();
                $rules['name'] = (String)Str::of($rules['name'])->append(',' . $role->id);
            }

            return $rules;
    }
}
