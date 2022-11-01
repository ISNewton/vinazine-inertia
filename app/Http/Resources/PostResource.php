<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
            'content' => $this->content,
            'user' => UserResource::make($this->whenLoaded('user')),
            'user_id' => $this->user_id,
            'thumbnail' => asset($this->thumbnail),
            'created_at' => $this->created_at,
            'status' => $this->status
        ];
    }
}
