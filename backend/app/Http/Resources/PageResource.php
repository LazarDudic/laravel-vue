<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $that = $this->getContentValues();

        return [
            'id' => $this->id,
            'title' => $that->title,
            'route' => $this->route,
            'menuTitle' => $that->menuTitle,
            'metaTitle' => $that->metaTitle,
            'metaDesc' => $that->metaDesc,
            'content' => $that->content,
            'lang_id' => $this->lang_id,
            'lang_group_id' => $this->lang_group_id,
            'socialImageID' => $that->socialImageID,
            'main_menu_show' => $this->main_menu_show,
            'footer_menu_show' => $this->footer_menu_show,
            'can_delete' => $this->can_delete,
            'image' => $this->whenLoaded('image', FileResource::make($this->image)),
            'language' => $this->whenLoaded('language', LanguageResource::make($this->language))
        ];
    }
}
