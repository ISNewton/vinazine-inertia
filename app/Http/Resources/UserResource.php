<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'avatar' => asset($this->avatar),
            'bio' => $this->bio,
            'is_blocked' => $this->is_blocked,
            'created_at' => $this->created_at,
            'user_type' => $this->role,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
