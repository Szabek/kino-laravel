<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'title' => $this->title,
            'category' => CategoryResource::make($this->category)->name,
            'author' => $this->author,
            'description' => $this->description,
            'trailer' => $this->trailer,
            'release_date' => $this->release_date,
            'picture_source' => $this->picture_source
        ];
    }
}
