<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'subcategory' => SubCategoryResource::make($this->whenLoaded('subcategory')),
            'description_short' => $this->description_short,
            'description_long' => $this->description_long,
            'regular_price' => $this->regular_price,
            'brand' => $this->brand?->name ?? 'No brand',
            'discount' => $this->sale_price ?? 0,
            'discount_price' => $this->sale_price == null ? 0 : intval($this->regular_price - $this->sale_price),
            'saved' => $this->sale_price == null ? 0 : intval($this->regular_price - $this->sale_price),
            'stock' => $this->stock_in - $this->stock_out,
            'rating' => $this->rating,
            'thumbnail' => getImageUrl($this->image),
            'gallery' => $this->galleryResource($this->images),
            'reviews' => ReviewResource::collection($this->whenLoaded('review')),
            'wishlist' => $this->wishList()->where('user_id', auth()->id())->first() ? true : false,
            'variants' =>  $this->whenLoaded('variants', function () {
                return $this->formatAttributes($this->variants);
            }),
        ];
    }

    private function galleryResource($images = [])
    {
        $data = [];
        foreach ($images as $image) {
            $data[] = asset($image->image);
        }
        return $data;
    }
}
