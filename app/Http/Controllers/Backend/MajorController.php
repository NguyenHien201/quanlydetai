<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\MajorServiceInterface as MajorService;
use App\Services\Interfaces\DepartmentServiceInterface as DepartmentService;
use App\Repositories\Interfaces\MajorRepositoryInterface as MajorReponsitory;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentReponsitory;

class MajorController extends Controller
{
    protected $majorService;
    protected $majorRepository;
    protected $departmentService;
    protected $departmentRepository;

    public function __construct(
        MajorService $majorService,
        MajorReponsitory $majorRepository,
        DepartmentService $departmentService,
        DepartmentReponsitory $departmentReponsitory
    ) {
        $this->majorService = $majorService;
        $this->majorRepository = $majorRepository;
        $this->departmentService = $departmentService;
        $this->departmentRepository = $departmentReponsitory;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'department.index');
        $majors = $this->majorService->paginate($request);
        // $template = 'backend.dashboard.major.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.major.index', compact('majors'), [
            'title' => 'Quản lý ngành học',
            'table' => 'Danh sách ngành học'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $departments = $this->departmentRepository->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.major.store', compact('config', 'departments'), [
            'title' => 'Thêm mới ngành học'
        ]);
    }

    public function store(StoreMajorRequest $request) {
        if($this->majorService->create($request)) {
            return redirect()->route('major.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('major.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $major = $this->majorRepository->findById($id);
        $departments = $this->departmentRepository->all();

        return view('backend.dashboard.major.store', compact('config', 'major', 'departments'), [
            'title' => 'Cập nhật ngành học'
        ]);
    }

    public function update(UpdateMajorRequest $request ,$id) {
        if($this->majorService->update($request, $id)) {
            return redirect()->route('major.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('major.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->majorService->destroy($id)) {
            return redirect()->route('major.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('major.index')->with('error', 'Xóa người dùng thất bại');
    }
}
