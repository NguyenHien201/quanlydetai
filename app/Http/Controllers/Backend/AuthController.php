<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct() {

    }

    public function index() {
        if(Auth::id() > 0) {
            return redirect()->route('index');
        }
        return view('backend.auth.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function login(AuthRequest $request) {
        
        $credentials = $request->only('username', 'password');
    
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return redirect()->route('index')->with('success', 'Đăng nhập tài khoản thành công');
        } else {
            $user = User::where('username', $request->username)->first();
    
            if(!$user) {
                return back()->with('error', 'Tài khoản không tồn tại');
            }
    
            if(!Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Mật khẩu không đúng');
            }
    
            // if($user->active == 0) {
            //     return back()->with('error', 'Tài khoản đã bị khóa');
            // }
        }
        return back()->with('error', 'Đăng nhập thất bại, vui lòng thử lại');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}
