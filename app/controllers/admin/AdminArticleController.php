<?php namespace App\Controllers\Admin;

use Likepie\Classification\Category;
use Likepie\Classification\CategoryRepository;
use Likepie\Classification\Taxonomy\TaxonomyRepository;
use Likepie\Classification\Taxons\TaxonRepository;
use Likepie\Articles\ArticleRepository;
use Likepie\Articles\ArticleCreator;
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
    /**
     * @var \Likepie\Classification\Taxons\TaxonRepository
     */
    protected $taxons;

    /** @var array */
    protected $availableCategories;

    /**
     * @var \Likepie\Classification\Category
     */
    private $category;

    public function __construct(
        ArticleRepository $model,
        ArticleCreator $articleCreator,
        TaxonRepository $taxons,
        CategoryRepository $category )
    {
        $this->model               = $model;
        $this->taxons              = $taxons;
        $this->articleCreator      = $articleCreator;
        $this->category            = $category;
        $this->availableCategories = $this->category->findAll()->lists('name', 'id');

        parent::__construct();
    }

    public function index()
    {
        $sortBy    = \Request::get('sortBy');
        $direction = \Request::get('direction');

        $articles  = $this->model->getPaginated(compact('sortBy', 'direction'));

        return View::make('backend.articles.index')
            ->with('articles', $articles);
    }

    public function create()
    {
        return View::make('backend.articles.create')
            ->with('categories', $this->availableCategories)
            ->with('statuses', $this->model->getModel()->getStatusEnumValuesForArray() );
    }

    public function store()
    {

        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->onValidationError($form->getErrors());
        }

        $article = $this->model->getNew(Input::only('title', 'content', 'status'));
        $article->author_id = 1;
        //$article->author_id = Auth::user()->id;

        if ( ! $article->save()) {
            return $this->onFormError();
        }

        // Store categories
        $tags = $this->taxons->findByIds(Input::get('categories'));

        dd($tags);
        //$article->tags()->sync($tags->lists('id'));

        return $this->onFormSuccess($article);

    }

    public function edit($id = null)
    {
        $article  = $this->model->findById($id);
        $statuses = $this->model->getModel()->getStatusEnumValuesForArray();
        return View::make('backend.articles.edit',
            [
                'article' => $article,
                'categories' => $this->availableCategories,
                'statuses' => $statuses
            ]
        );
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

    public function destroy( $id = null)
    {
        $article = $this->model->findById($id);
        //if ( Auth::user()->id != $article->author_id){ return $this->redirectBack(['error' => 'You cant delete an article you didnt create.']); }

        $article->delete();

        return $this->redirectBack(['success' => 'That article was successfully deleted.']);
    }

    public function onValidationError($errors)
    {
        return $this->redirectBack(['errors' => $errors]);
    }

    public function onFormError()
    {
        return $this->redirectBack(['error' => 'There was a problem saving that form']);
    }

    public function onFormSuccess( $article )
    {
        return $this->redirectToRoute('admin.articles.edit', ['id' => $article->id])
            ->with('success', 'Article has been saved successfully');
    }

}
