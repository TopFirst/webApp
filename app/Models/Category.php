<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category_name',
        'category_slug'
    ];
    protected $guard=['created_at'];
    
    public function post()
    {
        return $this->hasMany(Post::class,'category_ID');
    }
}
