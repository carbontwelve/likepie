<?php namespace Likepie\Classification\Taxonomy;

use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

class Taxonomy extends Ardent
{

    protected $table       = 'taxonomy';

    protected $with        = ['author'];

    protected $fillable    = ['author_id', 'name'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Classification\Taxonomy\TaxonomyPresenter';

    public static $rules  = [
        'author_id' => 'required|exists:users,id',
        'name'      => 'required'
    ];

    /**
     * Article BelongsTo Author relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('Likepie\Accounts\User', 'author_id');
    }

    public function taxons()
    {
        return $this->hasMany('Likepie\Classification\Taxons\Taxon', 'taxonomic_unit_id');
    }

}
