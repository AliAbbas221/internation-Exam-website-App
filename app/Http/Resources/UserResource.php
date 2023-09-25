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
            'id' => $this->uuid,
            'user_name' => $this->user_name,
            'phone' => $this->phone,
            'image' => isset($this->image) ? config('app.base_image_url') . $this->image : null,
            'created_at' => $this->created_at,
        ];
    }
}
