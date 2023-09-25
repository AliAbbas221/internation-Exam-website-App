<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'content' => $this->content,
            'reference' => $this->reference,
            'term' => isset($this->term) ? $this->term->term_name : null,
            'collage' => $this->collage->collage_name,
            'specialization' => $this->specialization->specialization_name,
        ];

    }
}
