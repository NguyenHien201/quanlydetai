<?php

namespace App\Services;

use App\Services\Interfaces\StudentGroupServiceInterface;
use App\Repositories\Interfaces\StudentGroupRepositoryInterface as StudentGroupRepository;
use App\Repositories\Interfaces\LecturerRepositoryInterface as LecturerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class StudentGroupService
 * @package App\Services
 */
class StudentGroupService extends BaseService implements StudentGroupServiceInterface
{

    protected $studentGroupRepository;
    protected $lecturerRepository;
    public function __construct(
        StudentGroupRepository $studentGroupRepository,
        LecturerRepository $lecturerRepository
    ) {
        $this->studentGroupRepository = $studentGroupRepository;
        $this->lecturerRepository = $lecturerRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $perPage = $request->integer('perpage');

        $lecturers = $this->studentGroupRepository->pagination(
            $this->select(),
            $condition,
            [],
            ['path' => 'student/index'],
            $perPage
        );
        return $lecturers;
    }

public function create(Request $request) {
    DB::beginTransaction();
    try {
        $payload = $request->except('_token', 'send');
        $students = $request->input('student_id');
        $lecturer = $this->lecturerRepository->findById($payload['lecturer_id']);

        $lecturer->students()->detach();
        $lecturer->students()->sync($students);

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();

        echo $e->getMessage();
        return false;
    }
}


public function update(Request $request, $id) {
    DB::beginTransaction();
    try {
        $payload = $request->except('_token', 'send');
        $students = $request->input('student_id');
        $payload['student_id'] = $students;

        $lecturer = $this->lecturerRepository->findById($payload['lecturer_id']);
        $lecturer->students()->detach();
        $lecturer->students()->sync($students);

        DB::commit();

        return true;
    } catch(\Exception $e) {
        DB::rollBack();
        echo $e->getMessage();
        return false;
    }
}


    public function destroy($id) {
        DB::beginTransaction();
        try {
            $student = $this->studentGroupRepository->forceDelete($id);
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
