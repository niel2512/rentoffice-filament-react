<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSpaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //diambil dari model office space
            //yang ada di database
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'address' => $this->address,
            'duration' => $this->duration,
            'price' => $this->price,
            'about' => $this->about,
            'thumbnail' => $this->thumbnail,

            //dibawah ini diambil dari relasi yang ada di model office space 
            //yaitu ORM city, photos, benefits

            //pake new hanya mengambil satu data //kalo belongs to pake new
            'city'=> new CityResource($this->whenLoaded('city')), 

            //pake collection mengambil banyak data //kalo has many pake collection
            'photos' => OfficeSpacePhotoResource::collection($this->whenLoaded('photos')), 
            'benefits' => OfficeSpaceBenefitResource::collection($this->whenLoaded('benefits')),
        ];
        
    }
}
