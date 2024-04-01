<?php

namespace App\Repositories\Interfaces;

/**
 * Interface LecturerRepositoryInterface
 * @package App\Services\Interfaces
 */
interface LecturerRepositoryInterface
{
    public function all();

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20
    );

    public function create(array $payload = []);
    public function findById(int $id);
    public function findByName(
        string $name,
        array $column = ['*'],
        array $relation = []
    );
    public function update(int $id = 0, array $payload = []);

    public function updateByWhereIn(
        string $whereInFeild = '',
        array $whereIn = [], 
        array $payload = []);

    public function delete(int $id);

    public function forceDelete(int $id);
}
