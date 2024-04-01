<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Services
 */
class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{

    protected $model;

    public function __construct(Student $model) {
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
        })->with('majors')
          ->with('school_years')
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
}
