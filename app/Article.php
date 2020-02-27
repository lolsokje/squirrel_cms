<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_twitch_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
