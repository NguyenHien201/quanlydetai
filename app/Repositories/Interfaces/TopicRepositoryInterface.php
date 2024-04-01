<?php

namespace App\Repositories\Interfaces;

/**
 * Interface TopicRepositoryInterface
 * @package App\Services\Interfaces
 */
interface TopicRepositoryInterface
{
    public function all();

    public function paginationByLecturer(
        array $column = ['*'],
        int $lecturer_id = 0,
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
        array $relations = []
    );

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20
    );

    public function create(array $payload = []);

    public function findById(int $modelId);

    public function update(int $id = 0, array $payload = []);

    public function updateByWhereIn(
        string $whereInFeild = '',
        array $whereIn = [], 
        array $payload = []);

    public function delete(int $id);

    public function forceDelete(int $id);
}
