<?php namespace Likepie\Taxons;

use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

class Taxon extends Ardent
{

    protected $table       = 'taxons';

    protected $with        = ['author', 'taxonomy'];

    protected $fillable    = ['author_id', 'name'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Taxonomy\TaxonomyPresenter';

    public static $rules  = [
        'author_id'   => 'required|exists:users,id',
        'name'        => 'required',
        'description' => 'alpha_num'
    ];

    /**
     * Article BelongsTo Author relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('Likepie\Accounts\User', 'author_id');
    }

    /**
     * Taxon BelongsTo Parent Taxon relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Likepie\Classification\Taxons\Taxon', 'parent_id');
    }

    /**
     * Taxon BelongsTo Taxonomy relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo('Likepie\Classification\Taxonomy\Taxonomy', 'taxonomic_unit_id');
    }

}
