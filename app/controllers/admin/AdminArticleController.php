<?php namespace App\Controllers\Admin;

use Likepie\Articles\ArticleRepository;
use Input;
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
        $articles = $this->model->getPaginated();

        return View::make('backend.articles.index')
            ->with('articles', $articles);
    }

    public function create()
    {
        return View::make('backend.articles.create')
            ->with('statuses', $this->model->getModel()->getStatusEnumValuesForArray() );
    }

    public function store()
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $article = $this->model->getNew(Input::only('title', 'content', 'status'));
        $article->author_id = 1;
        //$article->author_id = Auth::user()->id;

        if ( ! $article->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        // Store tags
        //$tags = $this->tags->getTagsByIds(Input::get('tags'));
        //$article->tags()->sync($tags->lists('id'));

        return $this->redirectToRoute('admin.articles.edit', ['id' => $article->id])
            ->with('success', 'Article has been saved successfully');

    }

    public function edit($id = null)
    {
        $article  = $this->model->findById($id);
        $statuses = $this->model->getModel()->getStatusEnumValuesForArray();
        return View::make('backend.articles.edit', ['article' => $article, 'statuses' => $statuses] );
    }

    public function update($id = null)
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $article = $this->model->findById($id);
        $article->fill( Input::only( 'title', 'content', 'status' ) );

        if ( ! $article->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        // Store tags
        //$tags = $this->tags->getTagsByIds(Input::get('tags'));
        //$article->tags()->sync($tags->lists('id'));

        return $this->redirectToRoute('admin.articles.edit', ['id' => $article->id])
            ->with('success', 'Article has been updated successfully');

    }

}
