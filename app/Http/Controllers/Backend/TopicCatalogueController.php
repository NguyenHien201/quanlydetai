<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicCatalogueRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\TopicCatalogueServiceInterface as TopicCatalogueService;
use App\Repositories\Interfaces\TopicCatalogueRepositoryInterface as TopicCatalogueReponsitory;

class TopicCatalogueController extends Controller
{
    protected $topicCatalogueService;
    protected $topicCatalogueRepository;

    public function __construct(
        TopicCatalogueService $topicCatalogueService,
        TopicCatalogueReponsitory $topicCatalogueRepository,
    ) {
        $this->topicCatalogueService = $topicCatalogueService;
        $this->topicCatalogueRepository = $topicCatalogueRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'userCatalogue.index');
        $topicCatalogues = $this->topicCatalogueService->paginate($request);
        // $template = 'backend.dashboard.topic.catalogue.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.topic.catalogue.index', compact('topicCatalogues'), [
            'title' => 'Quản lý nhóm đề tài',
            'table' => 'Danh sách nhóm đề tài'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.topic.catalogue.store', compact('config'), [
            'title' => 'Thêm mới nhóm đề tài'
        ]);
    }

    public function store(StoreTopicCatalogueRequest $request) {
        if($this->topicCatalogueService->create($request)) {
            return redirect()->route('topicCatalogue.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('topicCatalogue.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'userCatalogue.update');
        $config['method'] = 'edit';
        $topicCatalogue = $this->topicCatalogueRepository->findById($id);

        return view('backend.dashboard.topic.catalogue.store', compact('config', 'topicCatalogue'), [
            'title' => 'Cập nhật nhóm đề tài'
        ]);
    }

    public function update(StoreTopicCatalogueRequest $request ,$id) {
        if($this->topicCatalogueService->update($request, $id)) {
            return redirect()->route('topicCatalogue.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('topicCatalogue.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->topicCatalogueService->destroy($id)) {
            return redirect()->route('topicCatalogue.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('topicCatalogue.index')->with('error', 'Xóa người dùng thất bại');
    }
}
