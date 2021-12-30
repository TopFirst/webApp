<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'author_ID',
        'category_ID',
        'post_content',
        'post_short_content',
        'post_title',
        'post_slug',
        'post_type',
        'post_thumbnail',
    ];
    protected $guard=['created_at'];

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
}
