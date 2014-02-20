<?php
use Likepie\Articles\Article;
use Likepie\Articles\ArticleRepository;

class ArticleSeeder extends Seeder {

    /** @var \Likepie\Articles\ArticleRepository  */
    protected $model;

    public function __construct( ArticleRepository $articles )
    {
        $this->articles = $articles;
    }

    public function run()
    {

        DB::table('articles')->truncate();

        $demoPosts = array(

            [
                'title'     => 'Oink',
                'enabled'   => true,
                'status'    => Article::STATUS_PUBLISHED,
                'author_id' => 1,
                'content'   => "=== Oink, Oink\n\nI'm a pig!"
            ],
            array(
                'title'     => 'Woof',
                'enabled'   => true,
                'status'    => Article::STATUS_PUBLISHED,
                'author_id' => 1,
                'content'   => "=== Woof, Woof\n\nI'm a dog!"
            ),

        );

        foreach ($demoPosts as $post)
        {
            /** @var Article $article */
            $article = $this->articles->getNew($post);

            if ($this->articles->save($article) === false)
            {
                print_r($article->errors()->all());
            }
        }

        $this->command->comment('Inserted ' . $this->articles->countAll() . ' records into table');

    }
}
