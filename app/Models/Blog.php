<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'image',
        'description',
        'content',
    ];

    public function comment() {
        return $this->hasMany('App\Models\Comment', 'blog_id');
    }
}
