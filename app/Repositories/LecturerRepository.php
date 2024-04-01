<?php

namespace App\Repositories;

use App\Models\Lecturer;
use App\Repositories\Interfaces\LecturerRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class LecturerRepository
 * @package App\Services
 */
class LecturerRepository extends BaseRepository implements LecturerRepositoryInterface
{

    protected $model;

    public function __construct(Lecturer $model) {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
        array $relations = []
    ) {
        $query = $this->model->select($column)->where( function($query) use ($condition) {
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
            
        })->with('departments')
          ->with('positions')
          ->with('users');
        if(!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);

    }

    public function create(
        array $payload = []
    ) {
        $model =  $this->model->create($payload);
        return $model->fresh();
    }

    public function findByName(
        string $name,
        array $column = ['*'],
        array $relation = []
        ) {
            return $this->model->select($column)->with($relation)->where('code', $name)->firstOrFail();
    }
}
