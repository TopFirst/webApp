<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'post_type_name',
        'post_type_slug'
    ];
    protected $guard=['created_at'];
}
