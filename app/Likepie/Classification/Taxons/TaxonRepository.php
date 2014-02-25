<?php namespace Likepie\Classification\Taxons;

use Likepie\Core\EloquentRepository;

class TaxonRepository extends EloquentRepository
{

    public function __construct(Taxon $model)
    {
        $this->model = $model;
    }

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
                ->paginate();
        }

        return $this->model->with(['author'])
            ->paginate();
    }

    public function findByTaxonomy($taxonomy)
    {
        return $this->model->whereHas('taxonomy', function($q) use ($taxonomy)
            {
                $q->where('name', $taxonomy);

            })->get();
    }

    public function findByIds($ids)
    {
        if ( ! $ids) return null;
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getForm()
    {
        return new TaxonForm();
    }

}
