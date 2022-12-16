<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'title' => ['required', 'max:190'],
            'url_prefix' => ['required', 'max:190', Rule::unique('languages')->ignore($this->id)],
            'html_lang' => ['required', 'max:190'],
            'lang_code' => ['max:190', 'required', Rule::unique('languages')->ignore($this->id)],
            'status' => ['required', 'in:active,preparing'],
        ];
    }
}
