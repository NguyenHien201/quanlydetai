<?php

namespace App\Repositories;

use App\Models\Major;
use App\Repositories\Interfaces\MajorRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class MajorService
 * @package App\Services
 */
class MajorRepository extends BaseRepository implements MajorRepositoryInterface
{

    protected $model;
    public function __construct(Major $model) {
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
                      ->orWhere('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
            
        })->with('departments');
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
