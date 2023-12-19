<?php

namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Databases\Eloquent\Model;
/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    public function create(array $payload = []) {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id=0, array $payload = []) {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function all() {
        return $this->model->all();
    }

    public function findById(
        int $modelId, 
        array $column = ['*'], 
        array $relation = []
        ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}
