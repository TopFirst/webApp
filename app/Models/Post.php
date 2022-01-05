<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'id',
        'author_ID',
        'category_ID',
        'post_content',
        'post_short_content',
        'post_title',
        'post_slug',
        'post_type',
        'post_votes',
        'post_thumbnail',
    ];
    protected $guard=['created_at','updated_at'];
    protected $with=['kategori','tipe','author','komen'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search']??false,function($query, $search){
            return $query->where('post_title','like','%'.$search.'%')
                ->orWhere('post_content','like','%'.$search.'%');
        });
        $query->when($filters['category']??false,function($query, $category){
            return $query->whereHas('kategori',function($query)use($category){
                $query->where('category_slug',$category);
            });
        });
        $query->when($filters['author']??false,fn($query,$author)=>
            $query->whereHas('author',fn($query)=>
                $query->where('username',$author)
            )
        );
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author_ID');
    }
    public function kategori()
    {
        return $this->belongsTo(Category::class,'category_ID');
    }
    public function tipe()
    {
        return $this->belongsTo(PostType::class,'post_type');
    }
    public function komen()
    {
        return $this->hasMany(Comment::class);
    }
    public function details()
    {
        return $this->hasMany(PostDetail::class);
    }
    public function getRouteKeyName()
    {
        return 'post_slug';
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => 'post_title'
            ]
        ];
    }
}
