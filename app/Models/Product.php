<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'active',
        'art_number',
        'hit',
        'new',
        'stock',
        'advice',
        'sort',
        'category_id',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'summary',
        'description',
        'currency',
        'base_price',
        'price',
        'accessory'
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackPath(public_path('/images/not_photo.jpg'))
            ->registerMediaConversions(
                function () {
                    $this
                        ->addMediaConversion('miniature')
                        ->crop('crop-center', 100, 100);
                });

        $this->addMediaCollection('prev')
            ->singleFile()
            ->useFallbackPath(public_path('/images/canegory_not_img.jpg'));

        $this->addMediaCollection('more')
            ->registerMediaConversions(
                function () {
                    $this
                        ->addMediaConversion('thumb')
                        ->crop('crop-center', 100, 100);

                });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
