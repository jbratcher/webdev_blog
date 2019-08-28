<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Fillable props
     */
    protected $fillable = ['title', 'body', 'image'];

    /**
     * post - user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
