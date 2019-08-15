<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Fillable props
     */
    protected $fillable = ['user_id', 'title', 'body', 'image'];

    /**
     * post - user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
