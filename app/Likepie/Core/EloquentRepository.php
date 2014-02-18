<?php namespace Likepie\Core;

use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    /** @var \Illuminate\Database\Eloquent\Model  */
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function getAllPaginated($count = 10)
    {
        return $this->model->paginate($count);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|static
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $attributes
     * @return Model|static
     */
    public function getNew($attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * @param array|\Illuminate\Database\Eloquent\Model $data
     * @return mixed
     */
    public function save($data)
    {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * @param Model $model
     * @return mixed
     */
    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }

}
