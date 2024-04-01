<?php

namespace App\Services;

use App\Services\Interfaces\TopicCatalogueServiceInterface;
use App\Repositories\Interfaces\TopicCatalogueRepositoryInterface as TopicCatalogueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class TopicCatalogueService implements TopicCatalogueServiceInterface
{
    protected $userRepository;
    protected $topicCatalogueRepository;

    public function __construct(
        // UserRepository $userReponsitory,
        TopicCatalogueRepository $topicCatalogueRepository
    ) {
        // $this->userRepository = $userReponsitory;
        $this->topicCatalogueRepository = $topicCatalogueRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->input('publish');
        $perPage = $request->integer('perpage');
        $topicCatalogue = $this->topicCatalogueRepository->pagination(
            $this->select(),
            $condition,
            [],
            ['path' => 'user_catalogue/index'],
            $perPage,
        );

        return $topicCatalogue;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $topicCatalogue = $this->topicCatalogueRepository->create($payload);
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
            $user = $this->topicCatalogueRepository->update($id, $payload);
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
            $payload[$post['field']] = (($post['value'] == 1) ? 2:1);
            $topicCatalogue = $this->topicCatalogueRepository->update($post['modelId'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);
            
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
            
            $payload[$post['field']]  = $post['value'];
            $topicCatalogue = $this->topicCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);
            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            
            echo $e->getMessage();die();
            return false;
        }
    }

    public function changeUserStatus($post, $value) {
        DB::beginTransaction();
        try {
            $array = [];
            if(isset($post['modelId'])) {
                $array[] = $post['modelId'];
            }else{
                $array = $post['id'];
            }
            $payload[$post['field']] = $value;

            $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
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
            $user = $this->topicCatalogueRepository->forceDelete($id);
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