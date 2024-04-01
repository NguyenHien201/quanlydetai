<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class userRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model) {
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
                $query->where('username', 'LIKE', '%'.$condition['keyword'].'%');
            }

            if(isset($condition['publish']) && $condition['publish'] != 0) {
                $query->where('publish', '=', $condition['publish']);
            }
            
        })->with('user_catalogues');
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
            return $this->model->select($column)->with($relation)->where('username', $name)->firstOrFail();
    }
}
