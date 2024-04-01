<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService implements UserServiceInterface
{

    protected $userRepository;
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->input('publish');
        // $condition['user_catalogue_id'] = $request->input('user_catalogue_id');
        $perPage = $request->integer('perpage');
        $users = $this->userRepository->pagination(
            $this->select(), 
            $condition,
            [],
            ['path' => 'user/index'],
            $perPage
        );
        return $users;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        $avatar = null;
        try {
            $payload = $request->except('_token', 're_password', 'send');
            $payload['password'] = Hash::make($payload['password']);
            if(isset($payload['avatar'])) {
                $avatar = $this->uploadFile($payload['avatar'], 'avatars');
                $payload['avatar'] = $avatar['path'];
            }

            $user = $this->userRepository->create($payload);
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
        try {
            $payload = $request->except('_token', 'send');
            if(isset($payload['avatar'])) {
                $avatar = $this->uploadFile($payload['avatar'], 'avatars');
                $payload['avatar'] = $avatar['path'];
            }
            $user = $this->userRepository->update($id, $payload);
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

            $user = $this->userRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($post) {
        DB::beginTransaction();
        try {
            $payload = [
                $post['field'] => $post['value']
            ];

            $user = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);

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
            $user = $this->userRepository->forceDelete($id);
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
