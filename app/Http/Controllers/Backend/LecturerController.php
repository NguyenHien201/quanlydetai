<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LecturerServiceInterface as LecturerService;
use App\Repositories\Interfaces\LecturerRepositoryInterface as LecturerReponsitory;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentReponsitory;
use App\Repositories\Interfaces\PositionRepositoryInterface as PositionReponsitory;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueReponsitory;

class LecturerController extends Controller
{
    protected $lecturerService;
    protected $lecturerRepository;
    protected $departmentRepository;
    protected $positionRepository;
    protected $userCatalogueRepository;

    public function __construct(
        LecturerService $lecturerService,
        LecturerReponsitory $lecturerRepository,
        DepartmentReponsitory $departmentRepository,
        PositionReponsitory $positionRepository,
        UserCatalogueReponsitory $userCatalogueRepository,

    ) {
        $this->lecturerService = $lecturerService;
        $this->lecturerRepository = $lecturerRepository;
        $this->departmentRepository = $departmentRepository;
        $this->positionRepository = $positionRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'lecturer.index');
        $lecturers = $this->lecturerService->paginate($request);
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.user.lecturer.index', compact('lecturers'), [
            'title' => 'Quản lý thành viên',
            'table' => 'Danh sách thành viên'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'user.create');
        $config['seo'] = config('apps.user');
        $departments = $this->departmentRepository->all();
        $positions = $this->positionRepository->all();
        $usercatalogues = $this->userCatalogueRepository->all();
        $config['method'] = 'create';
        return view('backend.dashboard.user.lecturer.store', compact('config', 'departments', 'positions', 'usercatalogues'), [
            'title' => 'Thêm mới'
        ]);
    }

    public function store(StoreLecturerRequest $request) {
        if($this->lecturerService->create($request)) {
            return redirect()->route('lecturer.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('lecturer.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $departments = $this->departmentRepository->all();
        $positions = $this->positionRepository->all();
        $lecturer = $this->lecturerRepository->findById($id);
        $usercatalogues = $this->userCatalogueRepository->all();

        return view('backend.dashboard.user.lecturer.store', compact('config', 'lecturer', 'departments', 'positions', 'usercatalogues'), [
            'title' => 'Cập nhật'
        ]);
    }

    public function update(UpdateLecturerRequest $request ,$id) {
        if($this->lecturerService->update($request, $id)) {
            return redirect()->route('lecturer.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('lecturer.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'user.destroy');
        if($this->lecturerService->destroy($id)) {
            return redirect()->route('lecturer.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('lecturer.index')->with('error', 'Xóa người dùng thất bại');
    }
}
