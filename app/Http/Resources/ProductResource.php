<?php

namespace App\Http\Resources;

use App\Reposetories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PhotoResource;
use Illuminate\Support\Carbon;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'price' => $this->price,
            'photo' => PhotoResource::collection($this->photos),
            'seller' => UserResource::collection(UserRepository::getUser($this->user_id)),
            'created_at' => Carbon::parse($this->created_at),
        ];
    }
}
