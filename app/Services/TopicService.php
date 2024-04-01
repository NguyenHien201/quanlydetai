<?php

namespace App\Services;

use App\Services\Interfaces\TopicServiceInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface as TopicRepository;
use App\Repositories\Interfaces\LecturerRepositoryInterface as lecturerRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as userCatalogueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class TopicService implements TopicServiceInterface
{
    protected $userRepository;
    protected $lecturerRepository;
    protected $topicRepository;
    protected $userCatalogueRepository;

    public function __construct(
        TopicRepository $topicRepository,
        lecturerRepository $lecturerRepository,
        userCatalogueRepository $userCatalogueRepository
    ) {
        $this->topicRepository = $topicRepository;
        $this->lecturerRepository = $lecturerRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function paginate($request) {
        $user = auth()->user();
        $userCatalogue = $this->userCatalogueRepository->findById($user->user_catalogue_id);
        if ($userCatalogue->name == 'Giảng viên' || $userCatalogue->name == 'Giáo vụ') {
            $lecturer = $this->lecturerRepository->findByName($user->username);
            if (!empty($lecturer)) {
                $condition['keyword'] = $request->input('keyword');
                $perPage = $request->integer('perpage'); 

                $topic = $this->topicRepository->paginationByLecturer(
                    $this->select(),
                    $lecturer->id,
                    $condition,
                    [],
                    ['path' => 'topic/index'],
                    $perPage
                );

                return $topic;
            }
        }

        else if($userCatalogue->name == 'Quản trị viên') {
            $condition['keyword'] = $request->input('keyword');
                $perPage = $request->integer('perpage');
                $topic = $this->topicRepository->pagination(
                    $this->select(),
                    $condition,
                    [],
                    ['path' => 'topic/index'],
                    $perPage,
                );
                return $topic;
        }
        
        else {
            return false;
        }
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $payload = $request->except('_token', 'send');
            $lecturer = $this->lecturerRepository->findByName($user->username);
            if(!empty($lecturer)) {
                $payload['lecturer_id'] = $lecturer->id;
                $topic = $this->topicRepository->create($payload);
                DB::commit();
                return true;
            }
            return false;

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
            $user = auth()->user();
            $payload = $request->except('_token', 'send');
            $lecturer = $this->lecturerRepository->findByName($user->username);
            if(!empty($lecturer)) {
                $payload['lecturer_id'] = $lecturer->id;
                $topic = $this->topicRepository->update($id, $payload);
                DB::commit();

                return true;
            }

            return false;
        }catch(\Exception $e) {
            DB::rollBack();
            
            echo $e->getMessage();die();

            return false;
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $user = $this->topicRepository->forceDelete($id);
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