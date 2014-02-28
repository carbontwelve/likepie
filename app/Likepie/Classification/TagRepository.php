<?php namespace Likepie\Classification;

use Illuminate\Database\Eloquent\Collection;
use Likepie\Core\EloquentRepository;

class TagRepository extends EloquentRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new TagForm();
    }

    public function findByCommaInput ( $input )
    {
        if (strlen($input) < 1){ return null; }

        $input = explode(',', $input);

        /** @var \Illuminate\Database\Eloquent\Collection $tags */
        $tags  = $this->model->whereIn('name', $input)
            ->get();

        if (count($input) == $tags->count() ){ return $tags; }

        $tagCollection = new Collection();

        if ( ! $tags->isEmpty() )
        {
            // Check which tags are in the database and add those that are not already there
            $tagsInDatabase = $tags->lists('name');
            $tagCollection  = $tags;
            $input = array_diff( $input, $tagsInDatabase );

        }

        foreach ($input as $inputTag)
        {
            $record = $this->getNew([ 'name' => $inputTag ]);
            $record->author_id = 1;
            $record->save();

            $tagCollection->add($record);
        }
        return $tagCollection;
    }
}
