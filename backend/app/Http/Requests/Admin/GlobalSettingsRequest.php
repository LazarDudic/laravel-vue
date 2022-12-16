<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSettingsRequest extends FormRequest
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
            'facebook' => ['string', 'max:190', 'nullable'],
            'twitter' => ['string', 'max:190', 'nullable'],
            'youtube' => ['string', 'max:190', 'nullable'],
            'pinterest' => ['string', 'max:190', 'nullable'],
            'instagram' => ['string', 'max:190', 'nullable'],
            'linkedin' => ['string', 'max:190', 'nullable'],
            'discord' => ['string', 'max:190', 'nullable'],
            'address' => ['string', 'max:190', 'nullable'],
            'phone' => ['string', 'max:190', 'nullable'],
            'twitter_username' => ['string', 'max:190', 'nullable'],
            'email' => ['email', 'max:190', 'required'],
            'email_public' => ['email', 'max:190', 'nullable'],
            'facebook_app_id' => ['string', 'max:190', 'nullable'],
            'header_scripts' => ['string', 'nullable'],
            'sitename' => ['string', 'max:190', 'required'],
            'author' => ['string', 'nullable', 'max:190'],
            'status_message' => ['string', 'nullable', 'max:2047'],
            'copyright' => ['string', 'nullable'],
            'footer_text' => ['string', 'nullable'],
            'default_social_image_id' => ['nullable', 'exists:files,id'],
        ];
    }
}
