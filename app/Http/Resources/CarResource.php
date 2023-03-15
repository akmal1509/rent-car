<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'keyword' => $this->keyword,
            'metaDescription' => $this->metaDescription,
            'isActive' => $this->isActive,
            'brands' => $this->brands->only('id', 'name'),
            'users' => $this->users->only('id', 'name'),
            'image' => asset('/public/storage/upload/images/' . $this->image),
        ];
    }
}
