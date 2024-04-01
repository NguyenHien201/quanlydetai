<?php

namespace App\Services;

use App\Models\Lecturer;
use App\Services\Interfaces\LecturerServiceInterface;
use App\Repositories\Interfaces\LecturerRepositoryInterface as LecturerRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class LecturerService
 * @package App\Services
 */
class LecturerService extends BaseService implements LecturerServiceInterface
{

    protected $lecturerRepository;
    protected $userRepository;
    public function __construct(
        LecturerRepository $lecturerRepository,
        UserRepository $userRepository
    ) {
        $this->lecturerRepository = $lecturerRepository;
        $this->userRepository = $userRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        // $condition['publish'] = $request->input('publish');
        $perPage = $request->integer('perpage');
        $lecturers = $this->lecturerRepository->pagination(
            $this->select(), 
            $condition,
            [],
            ['path' => 'lecturer/index'],
            $perPage
        );
        return $lecturers;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $userCatalogue = $request->input('user_cataloge_id');
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
            $payload1['user_catalogue_id'] = $userCatalogue;

            $user = $this->userRepository->create($payload1);
            if($user)
            {
                $payload['user_id'] = $user->id;
                $lecturer = $this->lecturerRepository->create($payload);
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
        $user_id = Lecturer::where('id', $id)->first();
        $user = $this->userRepository->findByName($user_id->code);
        try {
            $userCatalogue = $request->input('user_cataloge_id');
            $payload = $request->except('_token', 'send');
            // if(isset($payload['avatar'])) {
            //     $avatar = $this->uploadFile($payload['avatar'], 'avatars');
            //     $payload['avatar'] = $avatar['path'];
            // }
            $payload1 = [];
            $payload1['username'] = $payload['code'];
            $payload1['user_catalogue_id'] = $userCatalogue;

            $lecturer = $this->lecturerRepository->update($id, $payload);
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

    public function updateStatus($post = []) {
    
        DB::beginTransaction();
        try {
            $payload = [
                $post['field'] => (($post['value'] == 1) ? 2:1)
            ];
            $lecturer = $this->lecturerRepository->update($post['modelId'], $payload);

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
        $user_id = Lecturer::where('id', $id)->first();
        $user = $this->userRepository->findByName($user_id->code);
        try {
            $lecturer = $this->lecturerRepository->forceDelete($id);
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
