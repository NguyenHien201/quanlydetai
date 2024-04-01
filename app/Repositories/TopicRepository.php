<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class TopicRepository
 * @package App\Services
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{

    protected $model;

    public function __construct(Topic $model) {
        $this->model = $model;
    }

    public function paginationByLecturer(
        array $column = ['*'],
        int $lecturer_id = 0,
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
        array $relations = []
    ) {
        $query = $this->model->select($column)
            ->where('lecturer_id', $lecturer_id)
            ->where(function($query) use ($condition) {
                if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $query->where('code', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('name', 'LIKE', '%'.$condition['keyword'].'%');
                }
            }
        );

        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);
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
        });

        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function findByName(
        string $name,
        array $column = ['*'],
        array $relation = []
        ) {
            return $this->model->select($column)->with($relation)->where('name', $name)->firstOrFail();
    }

    // public function findById(
    //     int $modelId,
    //     array $column = ['*'],
    //     array $relation = []
    //     ) {
    //         return $this->model->select($column)->with($relation)->where('lecturer_id', $modelId)->firstOrFail();
    // }
}
