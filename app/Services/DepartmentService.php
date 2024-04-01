<?php

namespace App\Services;

use App\Services\Interfaces\DepartmentServiceInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentService extends BaseService implements DepartmentServiceInterface
{
    protected $departmentRepository;

    public function __construct(
        DepartmentRepository $departmentRepository
    ) {
        $this->departmentRepository = $departmentRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $perPage = $request->integer('perpage');
        $department = $this->departmentRepository->pagination(
            $this->select(),
            $condition,
            [],
            ['path' => 'department/index'],
            $perPage
        );

        return $department;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $payload['start_time'] = $this->convertDate($payload['start_time']);
            $department = $this->departmentRepository->create($payload);
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
            $payload['start_time'] = $this->convertDate($payload['start_time']);
            $department = $this->departmentRepository->update($id, $payload);
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
            $user = $this->departmentRepository->forceDelete($id);
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