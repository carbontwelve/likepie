<?php namespace App\Controllers\Admin;

use Likepie\Articles\ArticleRepository;
use View;

/**
 * Class AdminArticleController
 * @package App\Controllers\Admin
 */
class AdminArticleController extends AdminBaseController {

    /**
     * @var ArticleRepository
     */
    protected $model;

    public function __construct( ArticleRepository $model )
    {

        $this->model = $model;
    }

    public function index()
    {

        return View::make('backend.dashboard');

    }

    public function create()
    {
        $article = array();

        return View::make('backend.articles.create')
            ->with('article', $article);
    }

}
