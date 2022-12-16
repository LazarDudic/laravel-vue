<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:190'],
            'lang_id' => ['required', 'exists:languages,id'],
            'lang_group_id' => ['nullable'],
            'type' => ['required', 'in:news,blog'],
            'image_id' => ['nullable', 'exists:files,id'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}