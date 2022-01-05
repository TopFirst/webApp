<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'id',
        'category_name',
        'category_slug',
        'thumbnail'
    ];
    protected $guard=['created_at'];
    
    public function post()
    {
        return $this->hasMany(Post::class,'category_ID');
    }
    public function getRouteKeyName()
    {
        return 'category_slug';
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'category_slug' => [
                'source' => 'category_name'
            ]
        ];
    }
}
