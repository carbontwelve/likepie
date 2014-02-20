<?php namespace Likepie\Articles;

use Likepie\Core\EloquentRepository;

class ArticleRepository extends EloquentRepository
{

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * Return a paginated record set
     * @param int $perPage
     * @return mixed
     */
    public function getPaginated( $perPage = 10 )
    {
        return $this->model->with(['author'])
            //->where('status', Article::STATUS_PUBLISHED)
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    public function getByTags($tags)
    {
        return $this->getArticleByTagsQuery($tags)
            ->get();
    }

    public function getPaginatedByTags($tags, $perPage = 10)
    {
        return $this->getArticleByTagsQuery($tags)
            ->paginate($perPage);
    }

    public function getForm()
    {
        return new ArticleForm();
    }

    private function getArticleByTagsQuery($tags)
    {

    }

}
