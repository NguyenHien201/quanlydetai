<?php

namespace App\Services;

use App\Services\Interfaces\MajorServiceInterface;
use App\Repositories\Interfaces\MajorRepositoryInterface as MajorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class majorService
 * @package App\Services
 */
class MajorService extends BaseService implements MajorServiceInterface
{

    protected $majorRepository;
    public function __construct(
        MajorRepository $majorRepository
    ) {
        $this->majorRepository = $majorRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->input('publish');
        // $condition['major_catalogue_id'] = $request->input('major_catalogue_id');
        $perPage = $request->integer('perpage');
        $majors = $this->majorRepository->pagination(
            $this->select(), 
            $condition,
            [],
            ['path' => 'major/index'],
            $perPage
        );
        return $majors;
    }

    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $major = $this->majorRepository->create($payload);
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
            $major = $this->majorRepository->update($id, $payload);
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

            $major = $this->majorRepository->update($post['modelId'], $payload);

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

            $major = $this->majorRepository->updateByWhereIn('id', $post['id'], $payload);

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
            $major = $this->majorRepository->forceDelete($id);
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
