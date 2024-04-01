<?php

namespace App\Services;

use App\Services\Interfaces\SchoolYearServiceInterface;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface as SchoolYearRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class SchoolYearService
 * @package App\Services
 */
class SchoolYearService extends BaseService implements SchoolYearServiceInterface
{
    protected $schoolYearRepository;

    public function __construct(
        SchoolYearRepository $schoolYearRepository
    ) {
        $this->schoolYearRepository = $schoolYearRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $perPage = $request->integer('perpage');
        $schoolYear = $this->schoolYearRepository->pagination(
            $this->select(),
            $condition,
            [],
            ['path' => 'school_year/index'],
            $perPage
        );

        return $schoolYear;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $payload['start_date'] = $this->convertDate($payload['start_date']);
            $payload['end_date'] = $this->convertDate($payload['end_date']);
            $schoolYear = $this->schoolYearRepository->create($payload);
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
            $payload['start_date'] = $this->convertDate($payload['start_date']);
            $payload['end_date'] = $this->convertDate($payload['end_date']);
            $schoolYear = $this->schoolYearRepository->update($id, $payload);
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
            $user = $this->schoolYearRepository->forceDelete($id);
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