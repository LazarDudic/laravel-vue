<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GlobalSettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sitename' => $this->sitename,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'pinterest' => $this->pinterest,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'discord' => $this->discord,
            'address' => $this->address,
            'phone' => $this->phone,
            $this->mergeWhen($request->user('api')?->isAdmin(), [
                'email' => $this->email,
                'facebook_app_id' => $this->facebook_app_id,
            ]),
            'twitter_username' => $this->twitter_username,
            'email_public' => $this->email_public,
            'header_scripts' => $this->header_scripts,
            'author' => $this->author,
            'status_message' => $this->status_message,
            'copyright' => $this->copyright,
            'footer_text' => $this->footer_text,
            'default_social_image_id' => $this->default_social_image_id,
        ];
    }
}
