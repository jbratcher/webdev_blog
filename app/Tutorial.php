<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    /**
     * Fillable props
     */
    protected $fillable = ['title', 'body', 'image_src'];

    /**
     * tutorial - user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
