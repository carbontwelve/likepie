<?php namespace App\Controllers\Admin;

use Likepie\Articles\ArticleRepository;
use BaseController;
use Redirect;
use Input;
use View;


/**
 * Class AdminBlogController
 * @package App\Controllers\Admin
 */
class AdminBlogController extends BaseController {


    /** @var \Likepie\Articles\ArticleRepository  */
    protected $articleService;

    /** @var string */
    private $articlesBasePath;

    public function __construct(ArticleRepository $articleService )
    {
        $this->articleService = $articleService;

        $this->articlesBasePath = app_path() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'articles';
        parent::__construct();
    }

    public function index()
    {
        $articles = $this->articleService->getPaginated();

        return View::make('backend.articles.index')
            ->with('articles', $articles);
    }

    public function create()
    {
        $articles = $this->articleService->getModel();

        return View::make('backend.articles.create')
            ->with('article', $articles);
    }

    public function store()
    {

        // Set up data structure
        $data            = Input::except(array('_token'));
        $data['enabled'] = true;

        $result          = $this->articleService->store($data);

        if ( $result instanceof \Illuminate\Http\RedirectResponse)
        {
            return $result;
        }

        return Redirect::route('admin.articles.edit', $result->id);

    }

    /**
     * @param null $id
     * @return \Illuminate\View\View
     */
    public function edit($id = null)
    {
        $article = $this->articleService->findById($id);

        return View::make('backend.articles.edit')
            ->with('article', $article);
    }

}
