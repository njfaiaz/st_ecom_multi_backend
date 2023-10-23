<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

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

    public function saveOrUpdate(Validator $validator, Product $product = null)
    {

        $inputs = $validator->validated();

        if (is_null($product)) {

            if (isset($inputs['image'])) {
                $inputs['image'] =  $this->uploadFile($inputs['image'], 'products');
            }

            $inputs['slug'] = Str::slug($inputs['name']);
            $product = Product::create($inputs);

            if (isset($inputs['gallery'])) {

                foreach ($inputs['gallery'] as $image) {

                    $image = $this->uploadFile($image, 'products');
                    $product->images()->create([
                        'image' => $image
                    ]);
                }
            }
        } else {

            if (isset($inputs['image'])) {
                $this->deleteFile($product->image);
                $inputs['image'] =  $this->uploadFile($inputs['image'], 'products');
            }


            if (isset($inputs['gallery'])) {

                if ($product->images) {
                    foreach ($product->images as $image) {
                        $this->deleteFile($image->image);
                        $image->delete();
                    }
                }

                foreach ($inputs['gallery'] as $image) {
                    $image = $this->uploadFile($image, 'products');
                    $product->images()->create([
                        'image' => $image
                    ]);
                }
            }

            $product->update($inputs);
        }
    }



}
