<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    protected $redirectTo = '/';

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

        $rules = [
            'name' => "required|unique:roles,name",
            'permissions' => "required"
        ];

        if($this->route('role')) {
            $role = Role::find($this->route('role'))->first();
            $rules['name'] = (String)Str::of($rules['name'])->append(',' . $role->id);
        }

        return $rules;
    }
}
