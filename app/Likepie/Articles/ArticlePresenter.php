<?php namespace Likepie\Articles;

use McCool\LaravelAutoPresenter\BasePresenter;
use Markdown;
use Str;

class ArticlePresenter extends BasePresenter
{

    /**
     * Marks up the article content using Markdown to html
     * @return string
     */
    public function content()
    {
        return Markdown::render($this->resource->content);
    }

    /**
     * Returns an extract from the full article
     * @return string
     */
    public function excerpt()
    {
        $html = Markdown::render($this->resource->content);
        $text = strip_tags($html);
        return Str::words($text, 200);
    }

    public function published_at()
    {
        if ($this->resource->published_at === null) { return 'Never'; }
        return $this->resource->published_at->toFormattedDateString();
    }

    public function published_ago()
    {
        if ($this->resource->published_at === null) { return 'Never'; }
        return $this->resource->published_at->diffForHumans();
    }
}
