<?php

namespace App\Repositories;

use App\Models\StudentGroup;
use App\Repositories\Interfaces\StudentGroupRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class StudentGroupRepository extends BaseRepository implements StudentGroupRepositoryInterface
{

    protected $model;

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
            ->paginate($perPage)->withQueryString();
    }

    public function __construct(StudentGroup $model) {
        $this->model = $model;
    }

    public function findStudentIdsByLecturerId(int $lecturerId): array {
        return $this->model->where('lecturer_id', $lecturerId)->pluck('student_id')->toArray();
    }

    public function getAllLecturerIds()
    {
        return $this->model->pluck('lecturer_id')->toArray();
    }

    public function getAllStudentIds()
    {
        return $this->model->pluck('student_id')->toArray();
    }
    

    // public function update(int $id = 0, array $payload = []) {
    //     $model = $this->findByIdLecturer($id);
    //     return $model->update($payload);
    // }

    // public function forceDelete(int $id = 0) {
    //     return $this->findByIdLecturer($id)->forceDelete();
    // }
}
