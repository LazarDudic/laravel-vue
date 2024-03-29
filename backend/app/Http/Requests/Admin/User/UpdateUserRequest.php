<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255'],
            'password' => ['nullable','string','min:6'],
            'role_id' => ['required','exists:roles,id'],
            'country' => ['nullable'],
            'city' => ['nullable'],
            'address' => ['nullable'],
            'phone' => ['nullable'],
        ];
    }
}
