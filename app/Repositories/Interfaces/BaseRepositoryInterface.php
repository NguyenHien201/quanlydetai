<?php

namespace App\Repositories\Interfaces;

use Flasher\Laravel\Http\Request;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all(array $relation);

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage,
        array $relations = []
    );

    public function updateByWhereIn(string $whereInFeild = '', array $whereIn = [], array $payload = []);
    public function findById(int $id);

    public function findByName(string $name);

    public function create(array $payload = []);

    public function update(int $id = 0, array $payload = []);


    public function delete(int $id = 0);

}
