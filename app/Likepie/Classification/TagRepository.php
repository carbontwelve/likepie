<?php namespace Likepie\Classification;

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

        if ( ! $tags->isEmpty() )
        {
            // Check which tags are in the database and add those that are not already there
            $tagsInDatabase = $tags->lists('name');
            foreach ($input as $inputTag)
            {

            }

            dd($tags);

        }

        foreach ($input as $inputTag)
        {
            $record = $this->getNew([ 'name' => $inputTag ]);
            $record->author_id = 1;
            var_dump($record->save());
        }

        dd ($input);

        //return $this->findByCommaInput( implode(',', $input) );

    }
}
