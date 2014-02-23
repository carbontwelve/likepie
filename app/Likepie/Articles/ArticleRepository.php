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
     * @param array $params
     * @return mixed
     */
    public function getPaginated( array $params )
    {
        if ($this->isSortable($params))
        {
            return $this->model->with(['author'])
                ->orderBy($params['sortBy'], $params['direction'])
                ->paginate();
        }

        if ($this->isFilterable($params))
        {
            return $this->model->with(['author'])
                ->where(function($query) use ($params){
                        foreach ($params['where'] as $where)
                        {
                            $query->where($where['column'], $where['is']);
                        }
                    })
                ->orderBy('published_at', 'desc')
                ->paginate();
        }

        return $this->model->with(['author'])
            ->orderBy('published_at', 'desc')
            ->paginate();
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

    public function findByTaxonomy($taxonomy)
    {
        return $this->model->whereHas('taxonomy', function($q)
            {
                //$q->where('content', 'like', 'foo%');

            })->get();
    }

    public function getForm()
    {
        return new ArticleForm();
    }

    private function getArticleByTagsQuery($tags)
    {

    }

}
