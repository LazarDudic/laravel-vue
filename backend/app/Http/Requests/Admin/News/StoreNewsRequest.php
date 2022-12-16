<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'lang_id' => ['required', 'exists:languages,id'],
            'lang_group_id' => ['nullable'],
            'title' => ['required', 'string', 'max:190'],
            'desc' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image_id' => ['required', 'exists:files,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
