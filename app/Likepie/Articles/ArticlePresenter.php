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
    public function html()
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

    /**
     * Published at, formatted as date
     * @return string
     */
    public function published_at()
    {
        if ($this->resource->published_at === null) { return 'Never'; }
        return $this->resource->published_at->toFormattedDateString();
    }

    /**
     * Published at, formatted as time ago
     * @return string
     */
    public function published_ago()
    {
        if ($this->resource->published_at === null) { return 'Never'; }
        return $this->resource->published_at->diffForHumans();
    }

    public function prettyStatus()
    {
        switch ($this->resource->status)
        {

            case Article::STATUS_PUBLISHED:
                return '<span class="text-success">Published</span>';
                break;

            case Article::STATUS_DRAFT:
                return '<span class="text-primary">Draft</span>';
                break;

            case Article::STATUS_PENDING:
                return '<span class="text-warning">Pending</span>';
                break;

            case Article::STATUS_REVISION:
                return '<span class="text-info">Revision</span>';
                break;

            default:
                return '';
        }
    }

}
