<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    /**
     * Fillable props
     */
    protected $fillable = ['title', 'body', 'image_src', 'demo_url', 'repo_url'];

    /**
     * post - user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
