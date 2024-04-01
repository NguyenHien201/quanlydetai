<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\StoreUserCatalogueRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PositionServiceInterface as PositionService;
use App\Repositories\Interfaces\PositionRepositoryInterface as PositionReponsitory;

class PositionController extends Controller
{
    protected $positionService;
    protected $positionRepository;

    public function __construct(
        PositionService $positionService,
        PositionReponsitory $positionRepository,
    ) {
        $this->positionService = $positionService;
        $this->positionRepository = $positionRepository;
    }

    public function index(Request $request) {
        $positions = $this->positionService->paginate($request);
        // $template = 'backend.dashboard.user.position.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.user.position.index', compact('positions'), [
            'title' => 'Quản lý chức vụ',
            'table' => 'Danh sách chức vụ'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.user.position.store', compact('config'), [
            'title' => 'Thêm mới tài khoản'
        ]);
    }

    public function store(StorePositionRequest $request) {
        if($this->positionService->create($request)) {
            return redirect()->route('position.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('position.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'userCatalogue.update');
        $config['method'] = 'edit';
        return view('backend.dashboard.user.position.create', compact('config'), [
            'title' => 'Cập nhật chức vụ'
        ]);
    }

    public function update(StorePositionRequest $request ,$id) {
        if($this->positionService->update($request, $id)) {
            return redirect()->route('position.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('position.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->positionService->destroy($id)) {
            return redirect()->route('position.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('position.index')->with('error', 'Xóa người dùng thất bại');
    }
}
