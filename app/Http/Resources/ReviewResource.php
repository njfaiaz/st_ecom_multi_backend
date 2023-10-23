<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'review' => $this->review,
            'rating' => $this->rating,
            'user_name' => $this->user->username,
            'create_time' => $this->created_at->format('d-m-Y'),
            'update_time' => $this->updated_at->format('d-m-Y'),
            'images' => $this->galleryResource($this->images),
        ];

    }

    private function galleryResource($images=[])
    {
        $data = [];
        foreach($images as $image) {
            $data[] = getImageUrl($image->image);
        }
        return $data;
    }
}
