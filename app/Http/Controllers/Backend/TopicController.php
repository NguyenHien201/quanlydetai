<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\TopicServiceInterface as TopicService;
use App\Repositories\Interfaces\TopicRepositoryInterface as TopicReponsitory;
use App\Repositories\Interfaces\TopicCatalogueRepositoryInterface as TopicCatalogueRepository;
use App\Repositories\Interfaces\MajorRepositoryInterface as MajorRepository;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface as SchoolYearRepository;
// use App\Repositories\Interfaces\LecturerRepositoryInterface as LecturerRepository;

class TopicController extends Controller
{
    protected $topicService;
    protected $topicCatalogueRepository;
    protected $topicRepository;
    protected $majorRepository;
    protected $schoolYearRepository;

    public function __construct(
        TopicService $topicService,
        TopicReponsitory $topicRepository,
        TopicCatalogueRepository $topicCatalogueRepository,
        MajorRepository $majorRepository,
        SchoolYearRepository $schoolYearRepository
    ) {
        $this->topicService = $topicService;
        $this->topicRepository = $topicRepository;
        $this->topicCatalogueRepository = $topicCatalogueRepository;
        $this->majorRepository = $majorRepository;
        $this->schoolYearRepository = $schoolYearRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'userCatalogue.index');
        $topics = $this->topicService->paginate($request);
        // $template = 'backend.dashboard.topic.topic.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.topic.topic.index', compact('topics'), [
            'title' => 'Quản lý đề tài',
            'table' => 'Danh sách đề tài'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        $majors = $this->majorRepository->all();
        $schoolYears = $this->schoolYearRepository->all();
        $catalogues = $this->topicCatalogueRepository->all();
        return view('backend.dashboard.topic.topic.store', compact('config', 'majors', 'schoolYears', 'catalogues'), [
            'title' => 'Thêm mới đề tài'
        ]);
    }

    public function store(StoreTopicRequest $request) {
        if($this->topicService->create($request)) {
            return redirect()->route('topic.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('topic.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'userCatalogue.update');
        $config['method'] = 'edit';
        $topic = $this->topicRepository->findById($id);
        $majors = $this->majorRepository->all();
        $schoolYears = $this->schoolYearRepository->all();
        $catalogues = $this->topicCatalogueRepository->all();
        return view('backend.dashboard.topic.topic.store', compact('config', 'topic', 'majors', 'schoolYears', 'catalogues'), [
            'title' => 'Cập nhật đề tài'
        ]);
    }

    public function update(StoreTopicRequest $request ,$id) {
        if($this->topicService->update($request, $id)) {
            return redirect()->route('topic.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('topic.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->topicService->destroy($id)) {
            return redirect()->route('topic.index')->with('success', 'Xóa thành công');
        }
        return redirect()->route('topic.index')->with('error', 'Xóa thất bại');
    }
}
