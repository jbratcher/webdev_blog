<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Fillable props
     */
    protected $fillable = ['title', 'body', 'image_src', 'slug'];

    /**
     * post - user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
