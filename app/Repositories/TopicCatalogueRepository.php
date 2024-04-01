<?php

namespace App\Repositories;

use App\Models\TopicCatalogue;
use App\Repositories\Interfaces\TopicCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class TopicCatalogueRepository
 * @package App\Services
 */
class TopicCatalogueRepository extends BaseRepository implements TopicCatalogueRepositoryInterface
{

    protected $model;

    public function __construct(TopicCatalogue $model) {
        $this->model = $model;
    }

    public function findByName(
        string $name,
        array $column = ['*'],
        array $relation = []
        ) {
            return $this->model->select($column)->with($relation)->where('name', $name)->firstOrFail();
    }

}
