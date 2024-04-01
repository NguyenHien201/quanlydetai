<?php

namespace App\Services;

use App\Services\Interfaces\PositionServiceInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface as PositionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class PositionService
 * @package App\Services
 */
class PositionService implements PositionServiceInterface
{
    // protected $userRepository;
    protected $positionRepository;

    public function __construct(
        PositionRepository $positionReponsitory
    ) {
        $this->positionRepository = $positionReponsitory;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $perPage = $request->integer('perpage');
        $position = $this->positionRepository->pagination(
            $this->select(),
            $condition,
            [],
            ['path' => 'position/index'],
            $perPage,
        );

        return $position;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $position = $this->positionRepository->create($payload);
            DB::commit();
            return true;

        }catch(\Exception $e) {
            DB::rollBack();

            echo $e->getMessage();die();
            return false;
        }
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $position = $this->positionRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $position = $this->positionRepository->forceDelete($id);
            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    private function select() {
        return [
            '*'
        ];
    }
}