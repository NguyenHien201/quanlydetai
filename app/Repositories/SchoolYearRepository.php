<?php

namespace App\Repositories;

use App\Models\SchoolYear;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class SchoolYearRepository
 * @package App\Services
 */
class SchoolYearRepository extends BaseRepository implements SchoolYearRepositoryInterface
{

    protected $model;

    public function __construct(SchoolYear $model) {
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
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('start_date', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('end_date', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
