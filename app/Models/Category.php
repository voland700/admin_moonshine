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

    public $appends = [
        'nested_name'
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
    //Accessors
    public function getNestedNameAttribute(): string
    {
        switch ($this->depth) {
            case 0:
                return $this->name;
                break;
            case 1:
                return '— '.$this->name;
                break;
            case 2:
                return '— — '.$this->name;
                break;
            case 3:
                return '— — — '.$this->name;
                break;
            case 4:
                return '— — — — '.$this->name;
                break;
            case $this->depth >= 5:
                return '— — — — ...'.$this->name;
                break;
            default: return $this->name;
        }
    }
}
