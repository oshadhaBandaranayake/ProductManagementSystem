<?php

namespace App\Repositories\Base;

use App\Repositories\Base\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $model = $this->model->findOrFail($id);
        $model->update($attributes);
        return $model;
    }

    public function deleteById(int $id)
    {
        return $this->model->destroy($id);
    }
}
