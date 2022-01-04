<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'opt_name',
        'opt_type',
        'opt_value',
        'opt_desc'
    ];
    protected $guard=['created_at'];
}
