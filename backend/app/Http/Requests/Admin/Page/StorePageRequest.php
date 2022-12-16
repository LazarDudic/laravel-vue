<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
            'menuTitle' => ['required', 'string', 'max:190'],
            'metaTitle' => ['required', 'string', 'max:190'],
            'metaDesc' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'socialImageID' => ['nullable', 'exists:files,id'],
            'can_delete' => ['required', 'in:yes,no'],
            'main_menu_show' => ['required', 'in:yes,no'],
            'footer_menu_show' => ['required', 'in:yes,no'],
            'route' => ['required', 'string', 'unique:pages'],
        ];
    }
}
