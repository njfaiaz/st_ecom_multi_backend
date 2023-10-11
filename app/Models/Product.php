<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function wishList()
    {
        return $this->hasOne(Wishlist::class);
    }

    public function formatAttributes($attributes)
    {
        $attribute_list = [];

        if(!empty($attributes)) {
            foreach($attributes as $key => $attribute){
                $attribute_list[$attribute->name][$key] = array(
                    'id' => $attribute->id,
                    'value' => $attribute->value,
                    'additional_price' => $attribute->additional_price
                );
            }
        }

        return $attribute_list;
    }

    public function getDiscountPercentageAttribute()
    {
        $price = $this->attributes['regular_price'];
        $amount = $price - $this->attributes['sale_price'];
        $discount = ($amount / $price) * 100;

        return round($discount);
    }
}
