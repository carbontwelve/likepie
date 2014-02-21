<?php

use Likepie\Articles\Article;
use Likepie\Articles\ArticleRepository;

class ArticleController extends BaseController {

    /** @var \Likepie\Articles\ArticleRepository  */
    protected $articleService;

    public function __construct(ArticleRepository $articleService )
    {
        $this->articleService = $articleService;
        parent::__construct();
    }

    public function homepage()
    {
        $articles = $this->articleService->getPaginated(['where' => [ [ 'column' => 'status', 'is' => Article::STATUS_PUBLISHED ] ] ]);

        return View::make('frontend.homepage')
            ->with('articles', $articles);
    }

    public function viewBySlug($slug)
    {

        $article = $this->articleService->getBySlug($slug);

        return View::make('frontend.single')
            ->with('article', $article);

    }
}
