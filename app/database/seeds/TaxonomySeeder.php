<?php
use Likepie\Classification\Taxonomy\Taxonomy;
use Likepie\Classification\Taxonomy\TaxonomyRepository;

class TaxonomySeeder extends Seeder {

    /** @var \Likepie\Articles\ArticleRepository  */
    protected $model;

    public function __construct( TaxonomyRepository $taxonomies )
    {
        $this->taxonomies = $taxonomies;
    }

    public function run()
    {

        DB::table('taxonomy')->truncate();

        $taxonomy = array(
            [
                'author_id' => 1,
                'name'      => 'Tag',
            ],
            [
                'author_id' => 1,
                'name'      => 'Category',
            ]
        );

        foreach ($taxonomy as $row)
        {
            /** @var Taxonomy $taxonomy */
            $newRow = $this->taxonomies->getNew($row);


            if ($this->taxonomies->save($newRow) === false)
            {
                print_r($newRow->errors()->all());
            }
        }

        $this->command->comment('Inserted ' . $this->taxonomies->countAll() . ' records into table');

    }
}
