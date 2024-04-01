<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Interfaces\StudentServiceInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface as StudentRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class StudentService
 * @package App\Services
 */
class StudentService extends BaseService implements StudentServiceInterface
{

    protected $studentRepository;
    protected $userRepository;
    protected $userCatalogueRepository;
    public function __construct(
        StudentRepository $studentRepository,
        UserRepository $userRepository,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        // $condition['publish'] = $request->input('publish');
        $perPage = $request->integer('perpage');
        $lecturers = $this->studentRepository->pagination(
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
            $userCatalogue = $this->userCatalogueRepository->findByName('Sinh viên');
            $payload = $request->except('_token', 'user_cataloge_id', 'send');
            // $payload['password'] = Hash::make($payload['password']);
            // if(isset($payload['avatar'])) {
            //     $avatar = $this->uploadFile($payload['avatar'], 'avatars');
            //     $payload['avatar'] = $avatar['path'];
            // }

            $payload1 = [];
            $payload1['username'] = $payload['code'];
            $payload1['password'] = $this->convertDateFromVN($payload['birthday']);
            $payload1['publish'] = 1;
            $payload1['user_catalogue_id'] = $userCatalogue->id;

            $user = $this->userRepository->create($payload1);
            if($user)
            {
                $payload['user_id'] = $user->id;
                $student = $this->studentRepository->create($payload);
            }
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
        $avatar = null;
        $user_id = Student::where('id', $id)->first();
        $user = $this->userRepository->findByName($user_id->code);
        try {
            $payload = $request->except('_token', 'send');
            // if(isset($payload['avatar'])) {
            //     $avatar = $this->uploadFile($payload['avatar'], 'avatars');
            //     $payload['avatar'] = $avatar['path'];
            // }

            $payload1 = [];
            $payload1['username'] = $payload['code'];

            $lecturer = $this->studentRepository->update($id, $payload);
            if($lecturer) {
                $userNew = $this->userRepository->update($user->id, $payload1);
            }
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
        $user_id = Student::where('id', $id)->first();
        $user = $this->userRepository->findByName($user_id->code);
        try {
            $student = $this->studentRepository->forceDelete($id);
            $user = $this->userRepository->deleteByName($user->username);
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
