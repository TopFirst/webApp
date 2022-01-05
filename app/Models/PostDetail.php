<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_ID',
        'item_name',
        'item_content',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_ID');
    }
}
