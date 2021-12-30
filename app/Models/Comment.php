<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'post_ID',
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        'comment_author_IP',
        'comment_content',
        'comment_approved',
        'user_id',
    ];
    protected $guard=['created_at'];
    
    public function komen()
    {
        return $this->belongsTo(Post::class,'post_ID');
    }
}
