<?php

use Likepie\Articles\ArticleRepository;

class BlogController extends BaseController {

    /** @var \Likepie\Articles\ArticleRepository  */
    protected $articleService;

    public function __construct(ArticleRepository $articleService )
    {
        $this->articleService = $articleService;
        parent::__construct();
    }

    public function homepage()
    {
        $articles = $this->articleService->getPaginated();

        return View::make('frontend.homepage')
            ->with('articles', $articles);
    }
}
