<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\DepartmentServiceInterface as DepartmentService;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentReponsitory;

class DepartmentController extends Controller
{
    protected $departmentService;
    protected $departmentRepository;

    public function __construct(
        DepartmentService $departmentService,
        DepartmentReponsitory $departmentRepository,
    ) {
        $this->departmentService = $departmentService;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'department.index');
        $departments = $this->departmentService->paginate($request);
        // $template = 'backend.dashboard.department.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.department.index', compact('departments'), [
            'title' => 'Quản lý ngành học',
            'table' => 'Danh sách ngành học'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.department.store', compact('config'), [
            'title' => 'Thêm mới ngành học'
        ]);
    }

    public function store(StoreDepartmentRequest $request) {
        if($this->departmentService->create($request)) {
            return redirect()->route('department.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('department.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $department = $this->departmentRepository->findById($id);

        return view('backend.dashboard.department.store', compact('config', 'department'), [
            'title' => 'Thêm mới ngành học'
        ]);
    }

    public function update(UpdateDepartmentRequest $request ,$id) {
        if($this->departmentService->update($request, $id)) {
            return redirect()->route('department.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('department.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->departmentService->destroy($id)) {
            return redirect()->route('department.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('department.index')->with('error', 'Xóa người dùng thất bại');
    }
}
