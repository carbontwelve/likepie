<?php namespace Likepie\Articles;

use Likepie\Core\EloquentRepository;
use DB;

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

    /**
     * @return array
     */
    public function stats($ignore = ['revision'])
    {
        $stats = [];

        foreach ($this->model->getStatusEnumValues() as $stat)
        {
            if ( ! in_array($stat, $ignore))
            {
                $stats[$stat] = 0;
            }
        }

        $rows =  DB::select("SELECT COUNT(`id`) as `count`, `status` FROM `{$this->model->getTable()}` GROUP BY `status`");

        if (count($rows) < 1){ return $stats; }

        foreach ($rows as $row)
        {
            if (isset($stats[$row->status]))
            {
                $stats[$row->status] = $row->count;
            }
        }

        return $stats;
    }

    public function getForm()
    {
        return new ArticleForm();
    }

    private function getArticleByTagsQuery($tags)
    {

    }

}
