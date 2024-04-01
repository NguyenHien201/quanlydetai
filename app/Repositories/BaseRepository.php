<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function all(array $relation = []) {
        return $this->model->with($relation)->get();
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
        array $relations = []
    ) {
        $query = $this->model->select($column);
        
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->relationCount($relations ?? null)
            ->customJoin($join ?? null)
            // paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path'])
            ->paginate($perPage)->withQueryString();
    }

    public function create(
        array $payload = []
    ) {
        $model =  $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id = 0, array $payload = []) {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateByWhereIn(
        string $whereInFeild = '',
        array $whereIn = [], 
        array $payload = []) {
        return $this->model->whereIn($whereInFeild, $whereIn)->update($payload);
    }

    public function delete(int $id = 0) {
        return $this->findById($id)->delete();
    }

    public function deleteByName(string $name) {
        return $this->findByName($name)->delete();
    }

    public function forceDelete(int $id = 0) {
        return $this->findById($id)->forceDelete();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
        ) {
            return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByName(
        string $name,
        array $column = ['*'],
        array $relation = []
        ) {
            return $this->model->select($column)->with($relation)->where('name', $name)->firstOrFail();
    }

}
