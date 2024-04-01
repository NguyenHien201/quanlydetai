<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{

    protected $model;

    public function __construct(Department $model) {
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
                $query->where('code', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('name', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('start_time', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);

    }
}
