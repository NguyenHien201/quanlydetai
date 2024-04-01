<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentGroupRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\Interfaces\StudentGroupServiceInterface as StudentGroupService;
use App\Repositories\Interfaces\StudentGroupRepositoryInterface as StudentGroupReponsitory;
use App\Repositories\Interfaces\StudentRepositoryInterface as StudentReponsitory;
use App\Repositories\Interfaces\LecturerRepositoryInterface as LecturerReponsitory;
use Illuminate\Support\Facades\DB;

class StudentGroupController extends Controller
{
    protected $studentGroupService;
    protected $studentGroupRepository;
    protected $lecturerRepository;
    protected $studentRepository;

    public function __construct(
        StudentGroupService $studentGroupService,
        StudentGroupReponsitory $studentGroupRepository,
        StudentReponsitory $studentReponsitory,
        LecturerReponsitory $lecturerReponsitory
    ) {
        $this->studentGroupService = $studentGroupService;
        $this->studentGroupRepository = $studentGroupRepository;
        $this->lecturerRepository = $lecturerReponsitory;
        $this->studentRepository = $studentReponsitory;
    }

    public function index(Request $request) {
        $studentGroups = $this->studentGroupService->paginate($request);
        $results = DB::table('students_group')
            ->select('lecturers.name as lecturer_name', 'students_group.lecturer_id', DB::raw('GROUP_CONCAT(students.name) AS student_names'))
            ->join('lecturers', 'students_group.lecturer_id', '=', 'lecturers.id')
            ->join('students', 'students_group.student_id', '=', 'students.id')
            ->groupBy('students_group.lecturer_id', 'lecturers.name')
            ->get();


    $lecturersArray = $results->toArray();
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.studentGroup.index', compact('studentGroups', 'lecturersArray'), [
            'title' => 'Quản lý nhóm sinh viên',
            'table' => 'Danh sách nhóm sinh viên'
        ]);
    }

    public function create() {
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
    
        // Lấy danh sách tất cả các lecturers và students
        $lecturers = $this->lecturerRepository->all();
        $students = $this->studentRepository->all();
    
        // Lấy danh sách các lecturer_id và student_id đã tồn tại trong bảng students_group
        $existingLecturerIds = $this->studentGroupRepository->getAllLecturerIds();
        $existingStudentIds = $this->studentGroupRepository->getAllStudentIds();
    
        // Loại bỏ các lecturer_id và student_id đã tồn tại khỏi danh sách lecturers và students
        $lecturers = $lecturers->reject(function ($lecturer) use ($existingLecturerIds) {
            return in_array($lecturer->id, $existingLecturerIds);
        });
    
        $students = $students->reject(function ($student) use ($existingStudentIds) {
            return in_array($student->id, $existingStudentIds);
        });
    
        return view('backend.dashboard.studentGroup.store', compact('config', 'lecturers', 'students'), [
            'title' => 'Tạo nhóm sinh viên'
        ]);
    }

    public function store(StoreStudentGroupRequest $request) {
        if($this->studentGroupService->create($request)) {
            return redirect()->route('student_group.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('student_group.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        $config['method'] = 'edit';
        // Lấy danh sách tất cả các lecturers và students
        $lecturers = $this->lecturerRepository->all();
        $students = $this->studentRepository->all();
    
        // Lấy thông tin của lecturer và studentGroup cần chỉnh sửa
        $lecturer = $this->lecturerRepository->findById($id);
        $studentIds = $this->studentGroupRepository->findStudentIdsByLecturerId($lecturer->id);
        $studentGroup = $this->studentGroupRepository->findById($id);
    
        // Lấy danh sách các lecturer_id và student_id đã tồn tại trong bảng students_group
        $existingLecturerIds = $this->studentGroupRepository->getAllLecturerIds();
        $existingStudentIds = $this->studentGroupRepository->getAllStudentIds();
    
        // Loại bỏ lecturer_id và student_id đã tồn tại khỏi danh sách lecturers và students
        $lecturers = $lecturers->reject(function ($lecturer) use ($existingLecturerIds) {
            return in_array($lecturer->id, $existingLecturerIds);
        });
    
        $students = $students->reject(function ($student) use ($existingStudentIds) {
            return in_array($student->id, $existingStudentIds);
        });
    
        return view('backend.dashboard.studentGroup.store', compact('config', 'studentGroup', 'lecturers', 'students', 'lecturer', 'studentIds'), [
            'title' => 'Cập nhật nhóm sinh viên'
        ]);
    }

    public function update(StoreStudentGroupRequest $request ,$id) {
        if($this->studentGroupService->update($request, $id)) {
            return redirect()->route('student_group.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('student_group.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->studentGroupService->destroy($id)) {
            return redirect()->route('student_group.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('student_group.index')->with('error', 'Xóa người dùng thất bại');
    }
}
