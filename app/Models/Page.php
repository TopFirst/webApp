<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_ID',
        'order_number',
        'title',
        'slug',
        'content',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'author_ID');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
