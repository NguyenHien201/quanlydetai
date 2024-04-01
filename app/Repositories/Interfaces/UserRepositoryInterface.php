<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface
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

    public function update(int $id = 0, array $payload = []);

    public function updateByWhereIn(
        string $whereInFeild = '',
        array $whereIn = [], 
        array $payload = []);

    public function delete(int $id);

    public function deleteByName(string $name);

    public function forceDelete(int $id);

    public function findByName(
        string $name,
        array $column = ['id'],
        array $relation = []
    );
}
