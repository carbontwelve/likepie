<?php namespace App\Controllers\Admin;

use Likepie\Classification\Taxonomy\TaxonomyRepository;
use Input;
use View;

/**
 * Class AdminTaxonomyController
 * @package App\Controllers\Admin
 */
class AdminTaxonomyController extends AdminBaseController {

    /**
     * @var \Likepie\Classification\Taxonomy\TaxonomyRepository
     */
    private $model;

    public function __construct(TaxonomyRepository $taxonomy)
    {
        $this->model = $taxonomy;
        parent::__construct();
    }

    public function index()
    {
        $taxonomy = $this->model->getAllPaginated();
        return View::make('backend.taxonomy.index')
            ->with('taxonomy', $taxonomy);
    }

    public function create()
    {
        return View::make('backend.taxonomy.create');
    }

    public function store()
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $taxonomy = $this->model->getNew(Input::only('name'));
        $taxonomy->author_id = 1;
        //$taxonomy->author_id = Auth::user()->id;

        if ( ! $taxonomy->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.taxonomy.edit', ['id' => $taxonomy->id])
            ->with('success', 'Taxonomy has been saved successfully');
    }

    public function edit($id)
    {
        $taxonomy  = $this->model->findById($id);
        return View::make('backend.taxonomy.edit', ['taxonomy' => $taxonomy] );
    }

    public function update($id)
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $taxonomy = $this->model->findById($id);
        $taxonomy->fill( Input::only( 'name' ) );

        if ( ! $taxonomy->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.taxonomy.edit', ['id' => $taxonomy->id])
            ->with('success', 'Taxonomy has been updated successfully');
    }

    public function destroy( $id = null)
    {
        $taxonomy = $this->model->findById($id);
        // if ( Auth::user()->id != $article->author_id){ return $this->redirectBack(['error' => 'You cant delete an article you didnt create.']); }
        // Should not be able to delete a taxonomy with taxons in use

        $taxonomy->delete();

        return $this->redirectBack(['success' => 'That taxonomy was successfully deleted.']);
    }
}
