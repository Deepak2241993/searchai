<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'long_content',
        'author_id',
        'blog_image',
        'status',
        'published_at'
    ];

    // If there's a relation to the User model (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
