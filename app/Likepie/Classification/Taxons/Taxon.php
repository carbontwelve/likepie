<?php namespace Likepie\Classification\Taxons;

use Likepie\Classification\Taxonomy\Taxonomy;
use LaravelBook\Ardent\Ardent;
use Closure;
use Cache;
use Str;

class Taxon extends Ardent
{

    const TAXONOMY_NAME    = 'Any';

    protected $table       = 'taxons';

    protected $with        = ['author', 'taxonomy'];

    protected $fillable    = ['author_id', 'taxonomic_unit_id', 'name', 'description'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Classification\Taxons\TaxonPresenter';

    public static $rules  = [
        'author_id'         => 'required|exists:users,id',
        'name'              => 'required',
        'taxonomic_unit_id' => 'required',
        'description'       => 'alpha_num'
    ];

    /**
     * Article BelongsTo Author relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('Likepie\Accounts\Users\User', 'author_id');
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

    /**
     * Extended Ardent save method to add taxonomic unit id
     *
     * @param array $rules
     * @param array $customMessages
     * @param array $options
     * @param callable $beforeSave
     * @param callable $afterSave
     * @return bool|void
     */
    public function save(array $rules = array(),
        array $customMessages = array(),
        array $options = array(),
        Closure $beforeSave = null,
        Closure $afterSave = null
    ){
        if ( ! isset($this->taxonomic_unit_id) )
        {
            $this->taxonomic_unit_id = $this->getTaxonomicUnitId();
        }

        return parent::save($rules,$customMessages, $options, $beforeSave, $afterSave);
    }

    /**
     * Limit Taxons to Just those with taxonomy of name
     *
     * @param bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        // If this is a Taxon request and not by specific taxonomy type
        if (static::TAXONOMY_NAME === 'Any')
        {
            return $query;
        }

        $query->where('taxonomic_unit_id', '=', $this->getTaxonomicUnitId());
        return $query;
    }

    /**
     * Generate the cache key for the taxon's taxonomy id
     * @return string
     */
    protected function getCacheKey()
    {
        return 'taxonomy_' . static::TAXONOMY_NAME . '_id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
     * @throws \Exception
     */
    public function getTaxonomicUnitId()
    {
        $cacheKey = $this->getCacheKey();

        if ( ! Cache::has( $cacheKey ))
        {
            $provider = new Taxonomy();
            $taxonomyUnitId = $provider->newQuery()->where( 'name', static::TAXONOMY_NAME )->first(array('id'));

            if ( is_null($taxonomyUnitId) )
            {
                throw new \Exception('A taxonomy with the name [' . static::TAXONOMY_NAME . '] does not exist in the taxonomy table.');
            }

            $taxonomyUnitId = $taxonomyUnitId->id;

            Cache::put($cacheKey, $taxonomyUnitId, 40320);

            return $taxonomyUnitId;

        }else{
            return Cache::get( $cacheKey );
        }
    }
}
