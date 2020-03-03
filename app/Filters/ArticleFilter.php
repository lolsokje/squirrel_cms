<?php

namespace App\Filters;

class ArticleFilter extends Filters
{
    protected array $filters = ['text', 'category', 'editor', 'status'];

    public function text(string $text)
    {
        return $this->builder
            ->where('title', 'LIKE', "%{$text}%")
            ->orWhere('body', 'LIKE', "%{$text}%");
    }

    public function category(int $category)
    {
        return $this->builder->where('category_id', $category);
    }

    public function editor(string $editor)
    {
        return $this->builder->where('user_twitch_id', $editor);
    }

    public function status(int $status)
    {
        return $this->builder->where('status_id', $status);
    }
}
