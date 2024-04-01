<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PositionRepository
 * @package App\Services
 */
class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{

    protected $model;

    public function __construct(Position $model) {
        $this->model = $model;
    }

}
