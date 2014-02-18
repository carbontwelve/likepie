<?php namespace Likepie\Articles;

class ArticleCreator
{

    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles = $articles;
    }

    public function create()
    {

    }


}
