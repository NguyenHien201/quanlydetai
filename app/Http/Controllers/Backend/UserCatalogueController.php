<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCatalogueRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueReponsitory;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    protected $permissionRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueReponsitory $userCatalogueRepository,
        // PermissionReponsitory $permissionRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
        // $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'userCatalogue.index');
        $userCatalogues = $this->userCatalogueService->paginate($request);
        // $template = 'backend.dashboard.user.catalogue.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.user.catalogue.index', compact('userCatalogues'), [
            'title' => 'Quản lý nhóm quyền',
            'table' => 'Danh sách nhóm quyền'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.user.catalogue.create', compact('config'), [
            'title' => 'Thêm mới tài khoản'
        ]);
    }

    public function store(StoreUserCatalogueRequest $request) {
        if($this->userCatalogueService->create($request)) {
            return redirect()->route('userCatalogue.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('userCatalogue.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'userCatalogue.update');
        $config['method'] = 'edit';
        $userCatalogue = $this->userCatalogueRepository->findById($id);

        return view('backend.dashboard.user.catalogue.create', compact('config', 'userCatalogue'), [
            'title' => 'Cập nhật nhóm quyền'
        ]);
    }

    public function update(StoreUserCatalogueRequest $request ,$id) {
        if($this->userCatalogueService->update($request, $id)) {
            return redirect()->route('userCatalogue.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('userCatalogue.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->userCatalogueService->destroy($id)) {
            return redirect()->route('userCatalogue.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('userCatalogue.index')->with('error', 'Xóa người dùng thất bại');
    }

    // public function permission() {
    //     $this->authorize('modules', 'user_catalogue.permission');
    //     $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
    //     $permissions = $this->permissionRepository->all();

    //     return view('backend.dashboard.user.catalogue.permission', compact('userCatalogues', 'permissions'), [
    //         'title' => 'Phân quyền'
    //     ]);
    // }

    // public function updatePermission(Request $request) {
    //     if($this->userCatalogueService->setPermission($request)) {
    //         return redirect()->route('userCatalogue.index')->with('success', 'Cập nhật thành công');
    //     }
    //     return redirect()->route('userCatalogue.index')->with('error', 'cập nhật thất bại');
    // }
}
