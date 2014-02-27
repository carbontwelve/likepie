<?php namespace Likepie\Articles;

use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

class Article extends Ardent
{

    protected $table       = 'articles';

    protected $with        = ['author'];

    protected $fillable    = ['author_id', 'title', 'slug', 'content' ,'status', 'revision', 'published_at'];

    protected $dates       = ['published_at'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Articles\ArticlePresenter';

    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REVISION  = 'revision';
    const STATUS_PENDING   = 'pending';

    public static $rules  = [
        'author_id' => 'required|exists:users,id',
        'title'     => 'required',
        'content'   => 'required',
        'status'    => 'required'
    ];

    /**
     * Return status enum values
     * @return array
     */
    public function getStatusEnumValues()
    {
        return array(
            static::STATUS_DRAFT,
            static::STATUS_PUBLISHED,
            static::STATUS_PENDING,
            static::STATUS_REVISION
        );
    }

    /**
     * @return array
     */
    public function getStatusEnumValuesForArray()
    {
        $array = array();
        $enum  = $this->getStatusEnumValues();
        foreach ($enum as $value)
        {
            $array[$value] = ucfirst($value);
        }
        return $array;
    }

    public function hasErrors()
    {
        return count($this->errors()->all());
    }

    /**
     * Article BelongsTo Author relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('Likepie\Accounts\User', 'author_id');
    }

    public function tags()
    {
        return $this->morphToMany('Likepie\Classification\Tag', 'taggable');
    }

    public function categories()
    {
        //return $this->belongsToMany('Likepie\Tags\Tag', 'article_tag', 'article_id', 'tag_id');
    }

    /**
     * Actions to undertake on a save event
     */
    public function beforeSave()
    {
        $this->attributes['slug'] = $this->generateSlug();

        if ($this->status == static::STATUS_PUBLISHED && ! $this->published_at)
        {
            $this->published_at = $this->freshTimestamp();
        }
    }

    /**
     * Are we a published record?
     * @return bool
     */
    public function isPublished()
    {
        if ($this->exists && $this->status == static::STATUS_PUBLISHED){
            return true;
        }

        return false;
    }

    public function setTags(array $tagIds)
    {
        $this->tags()->sync($tagIds);
    }

    public function getTags()
    {

    }

    public function hasTag($tagId)
    {
        return $this->tags->contains($tagId);
    }

    /**
     * Generate a slug for this record
     * @return string
     */
    private function generateSlug()
    {
        $i = 0;

        while ($this->getCountBySlug($this->generateSlugByIncrementer($i)) > 0) {
            $i++;
        }

        return $this->generateSlugByIncrementer($i);
    }

    /**
     * Generates a new slug for this record
     * @param int $i
     * @return string
     */
    private function generateSlugByIncrementer($i)
    {
        if ($i == 0) $i = '';

        if ($this->created_at) {
            $date = date('m-d-Y', strtotime($this->created_at));
        } else {
            $date = date('m-d-Y');
        }

        return Str::slug("{$date} - {$this->title}" . $i);
    }

    /**
     * Counts slugs
     * @param string $slug
     * @return int
     */
    private function getCountBySlug($slug)
    {
        $query = $this->newQuery();
        $query = $query->where('slug', '=', $slug);

        // Exclude current record slug so we wont keep incrementing each time you update a record
        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        return $query->count();
    }

}
