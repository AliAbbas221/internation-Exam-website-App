<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CodeResource extends JsonResource
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
            'value' => $this->value,
            'user' => isset($this->user) ? $this->user->user_name : null,
            'collage' => isset($this->collage) ? $this->collage->collage_name : null,
        ];
    }
}
