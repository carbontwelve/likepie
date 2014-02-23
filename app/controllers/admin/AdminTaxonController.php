<?php namespace App\Controllers\Admin;

use Likepie\Classification\Taxonomy\TaxonomyRepository;
use Likepie\Classification\Taxons\TaxonRepository;
use Input;
use View;

/**
 * Class AdminTaxonController
 * @package App\Controllers\Admin
 */
class AdminTaxonController extends AdminBaseController {

    /**
     * @var \Likepie\Classification\Taxons\TaxonRepository
     */
    private $model;
    /**
     * @var \Likepie\Classification\Taxonomy\TaxonomyRepository
     */
    private $taxonomy;

    public function __construct( TaxonRepository $model, TaxonomyRepository $taxonomy )
    {
        $this->model    = $model;
        $this->taxonomy = $taxonomy;
        parent::__construct();
    }

    public function index()
    {
        $taxons = $this->model->getAllPaginated();

        return View::make('backend.taxons.index')
            ->with('taxons', $taxons);
    }

    public function create()
    {
        $taxonomy = $this->taxonomy->getList('name', 'id');
        return View::make('backend.taxons.create')
            ->with('taxonomy', $taxonomy);
    }

    public function store()
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $taxon = $this->model->getNew(Input::only('name', 'taxonomic_unit_id'));
        $taxon->author_id = 1;
        //$taxon->author_id = Auth::user()->id;

        if ( ! $taxon->save()) {

            dd($taxon);
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.taxons.edit', ['id' => $taxon->id])
            ->with('success', 'Taxon has been saved successfully');
    }

    public function edit($id)
    {
        $taxonomy = $this->taxonomy->getList('name', 'id');
        $taxon    = $this->model->findById($id);
        return View::make('backend.taxons.edit', ['taxon' => $taxon, 'taxonomy' => $taxonomy] );
    }

    public function update($id)
    {
        $form = $this->model->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $taxon = $this->model->findById($id);
        $taxon->fill( Input::only( 'name', 'taxonomic_unit_id' ) );

        if ( ! $taxon->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.taxons.edit', ['id' => $taxon->id])
            ->with('success', 'Taxons has been updated successfully');
    }

    public function destroy( $id = null)
    {
        $taxon = $this->model->findById($id);
        // if ( Auth::user()->id != $article->author_id){ return $this->redirectBack(['error' => 'You cant delete an article you didnt create.']); }
        // Should not be able to delete a taxon with relationships in use

        $taxon->delete();

        return $this->redirectBack(['success' => 'That taxon was successfully deleted.']);
    }

}
