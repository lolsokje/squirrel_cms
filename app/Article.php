<?php

namespace App;

use App\Filters\ArticleFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_twitch_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function url()
    {
        return $this->status->name === 'published' ? route('articles.show', $this) : route('articles.edit', $this);
    }

    public function setStatus(string $status)
    {
        $status = Status::where('name', $status)->first();

        if (!$status) {
            return;
        }

        $this->status()->dissociate();
        $this->status()->associate($status);
        $this->save();
    }

    public function scopeFilter($query, ArticleFilter $filters)
    {
        return $filters->apply($query);
    }
}
