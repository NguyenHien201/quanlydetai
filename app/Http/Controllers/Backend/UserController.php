<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserReponsitory;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueReponsitory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;

    protected $userRepository;
    protected $userCatalogueReponsitory;

    public function __construct(
        UserService $userService,
        UserReponsitory $userRepository,
        UserCatalogueReponsitory $userCatalogueReponsitory
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->userCatalogueReponsitory = $userCatalogueReponsitory;
    }

    public function index(Request $request) {
        // $this->authorize('modules', 'user.index');
        $users = $this->userService->paginate($request);
        $user_catalogues = $this->userCatalogueReponsitory->all();
        $config['seo'] = config('apps.user');
        return view('backend.dashboard.user.user.index', compact('users', 'user_catalogues'), [
            'title' => 'Quản lý thành viên',
            'table' => 'Danh sách thành viên'
        ]);
    }

    public function create() {
        // $this->authorize('modules', 'user.create');
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $user_catalogues = $this->userCatalogueReponsitory->all();
        return view('backend.dashboard.user.user.store', compact('config', 'user_catalogues'), [
            'title' => 'Thêm mới tài khoản'
        ]);
    }

    public function store(StoreUserRequest $request) {
        if($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới thất bại');
    }

    public function edit($id) {
        // $this->authorize('modules', 'user.update');
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $user = $this->userRepository->findById($id);
        $user_catalogues = $this->userCatalogueReponsitory->all();

        return view('backend.dashboard.user.user.store', compact('config', 'user', 'user_catalogues'), [
            'title' => 'Cập nhật tài khoản'
        ]);
    }

    public function update(UpdateUserRequest $request ,$id) {
        if($this->userService->update($request, $id)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật thất bại');
    }

    public function destroy($id) {
        // $this->authorize('modules', 'user.destroy');
        if($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa người dùng thất bại');
    }

    // public function profile($id) {
    //     $user = User::where('id', $id)->first();
    //     return view('dashboard.user.user.profile', compact('user'), [
    //         'title' => 'Thông tin người dùng'
    //     ]);
    // }

    // public function changeInfo(Request $request, $id) {
    //     $user = User::findOrFail($id);
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => [
    //             'required',
    //             Rule::unique('users')->ignore($user->id),
    //         ],
    //         'phone' => [
    //             'required',
    //             Rule::unique('users')->ignore($user->id),
    //         ],
    //         'address' => 'required',
    //     ], [
    //         'name.required' => 'Vui lòng nhập họ tên',
    //         'email.required' => 'Vui lòng nhập email',
    //         'email.unique' => 'email đã tồn tại',
    //         'address.required' => 'vui lòng nhập địa chỉ',
    //     ]);

    //     $avatar = $request->file('avatar');
    //     if($avatar) {
    //         $fileName = Str::slug('avt') . '-' . date('dmYhms') . '.jpg';
    //         $avatar->storeAs('public/images/avatar', $fileName);
    //     }
    //     else {
    //         $fileName = $user->avatar;
    //     }

    //     User::where('id', $id)
    //     ->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'address' => $request->address,
    //         'phone' => $request->phone,
    //         'avatar' => $fileName,
    //     ]);
        
    //     Toastr::success('Cập nhật thành công');
    //     return redirect()->back();
    // }

    // public function changePassword(Request $request, $id) {
    //     $user = User::findOrFail($id);

    //     if($request->has('password') && !empty($request->password))
    //     {
    //         $user = User::findOrFail($id);
    //         if(!Hash::check($request->password, $user->password))
    //         {
    //             return back()->with('error', 'Mật khẩu cũ không đúng');
    //         }
    //         if(!empty($request->newPassword) < 6) {
    //             return back()->with('error', 'Mật khẩu phải ít nhất 6 ký tự');
    //         }

    //         if($request->newPassword != $request->newPassword_confirmation) {
    //             return back()->with('error', 'Mật khẩu mới không đúng');
    //         }
    //         User::where('id', $id)
    //         ->update([
    //             'password' => Hash::make($request->newPassword),
    //         ]);
    //         Toastr::success('Cập nhật thành công');
    //         return redirect()->back();

    //     }
    //     else {
    //         Toastr::success('Cập nhật thành công');
    //         return redirect()->back();
    //     }
    // }


}