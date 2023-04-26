<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Category extends Model implements HasMedia

{
    use NodeTrait, InteractsWithMedia;

    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        '_lft ',
        '_rgt ',
        'name',
        'slug',
        'active',
        'sort',
        'description',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category')
            ->singleFile()
            ->useFallbackPath(public_path('/images/canegory_not_img.jpg'));
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
