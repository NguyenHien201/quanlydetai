<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolYearRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\SchoolYearServiceInterface as SchoolYearService;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface as SchoolYearReponsitory;

class SchoolYearController extends Controller
{
    protected $schoolYearService;
    protected $schoolYearRepository;

    public function __construct(
        SchoolYearService $schoolYearService,
        SchoolYearReponsitory $schoolYearRepository,
    ) {
        $this->schoolYearService = $schoolYearService;
        $this->schoolYearRepository = $schoolYearRepository;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'department.index');
        $schoolYears = $this->schoolYearService->paginate($request);
        // $template = 'backend.dashboard.schoolYear.index';
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.schoolYear.index', compact('schoolYears'), [
            'title' => 'Quản lý niên khóa',
            'table' => 'Danh sách niên khóa'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'userCatalogue.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        return view('backend.dashboard.schoolYear.store', compact('config'), [
            'title' => 'Thêm mới niên khóa'
        ]);
    }

    public function store(StoreSchoolYearRequest $request) {
        if($this->schoolYearService->create($request)) {
            return redirect()->route('school_year.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('school_year.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $schoolYear = $this->schoolYearRepository->findById($id);

        return view('backend.dashboard.schoolYear.store', compact('config', 'schoolYear'), [
            'title' => 'Cập nhật niên khóa'
        ]);
    }

    public function update(StoreSchoolYearRequest $request ,$id) {
        if($this->schoolYearService->update($request, $id)) {
            return redirect()->route('school_year.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('school_year.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'userCatalogue.destroy');
        if($this->schoolYearService->destroy($id)) {
            return redirect()->route('school_year.index')->with('success', 'Xóa niên khóa thành công');
        }
        return redirect()->route('school_year.index')->with('error', 'Xóa niên khóa thất bại');
    }
}
