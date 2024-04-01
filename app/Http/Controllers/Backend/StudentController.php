<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\StudentServiceInterface as StudentService;
use App\Repositories\Interfaces\StudentRepositoryInterface as StudentReponsitory;
use App\Repositories\Interfaces\MajorRepositoryInterface as MajorReponsitory;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface as SchoolYearReponsitory;

class StudentController extends Controller
{
    protected $studentService;
    protected $studentRepository;
    protected $majorReponsitory;
    protected $schoolYearReponsitory;
    protected $userCatalogueRepository;

    public function __construct(
        StudentService $studentService,
        StudentReponsitory $studentRepository,
        MajorReponsitory $majorReponsitory,
        SchoolYearReponsitory $schoolYearReponsitory,

    ) {
        $this->studentService = $studentService;
        $this->studentRepository = $studentRepository;
        $this->majorReponsitory = $majorReponsitory;
        $this->schoolYearReponsitory = $schoolYearReponsitory;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'student.index');
        $students = $this->studentService->paginate($request);
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.user.student.index', compact('students'), [
            'title' => 'Quản lý thành viên',
            'table' => 'Danh sách thành viên'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'user.create');
        $config['seo'] = config('apps.user');
        $majors = $this->majorReponsitory->all();
        $schoolYears = $this->schoolYearReponsitory->all();
        $config['method'] = 'create';
        return view('backend.dashboard.user.student.store', compact('config', 'majors', 'schoolYears'), [
            'title' => 'Thêm mới'
        ]);
    }

    public function store(StoreStudentRequest $request) {
        if($this->studentService->create($request)) {
            return redirect()->route('student.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('student.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $majors = $this->majorReponsitory->all();
        $schoolYears = $this->schoolYearReponsitory->all();
        $student = $this->studentRepository->findById($id);

        return view('backend.dashboard.user.student.store', compact('config', 'student', 'majors', 'schoolYears'), [
            'title' => 'Cập nhật'
        ]);
    }

    public function update(UpdateStudentRequest $request ,$id) {
        if($this->studentService->update($request, $id)) {
            return redirect()->route('student.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('student.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'user.destroy');
        if($this->studentService->destroy($id)) {
            return redirect()->route('student.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('student.index')->with('error', 'Xóa người dùng thất bại');
    }
}