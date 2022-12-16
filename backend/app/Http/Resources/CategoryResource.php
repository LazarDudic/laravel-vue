<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'name' => $this->title,
            'type' => $this->type,
            'lang_id' => $this->lang_id,
            'lang_group_id' => $this->lang_group_id,
            'image_id' => $this->image_id,
            'image' => $this->whenLoaded('image', FileResource::make($this->image)),
            'language' => $this->whenLoaded('language', LanguageResource::make($this->language)),
            'created_at' => $this->created_at->format('d-m-Y H:i'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i'),
            'parent' => $this->whenLoaded('parent', CategoryResource::make($this->parent->first())),
            'parent_id' => $this->whenLoaded('parent', $this->parent->first()?->id),
        ];
    }
}
