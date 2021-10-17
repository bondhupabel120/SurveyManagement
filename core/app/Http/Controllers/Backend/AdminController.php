<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function adminLogin()
    {
        if (Auth::guard('admin')->check()) {
            return route('admin.dashboard');
        } else {
            return view('backend.admin.login');
        }
    }
    public function adminLoginCheck(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember_me = $request->has('remember') ? true : false;
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember_me) || Auth::guard('admin')->attempt([
            'phone' => $request->email,
            'password' => $request->password,
        ], $remember_me)) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('message', 'Your Login Credentials are Invalid!')->withErrors('Your Login Credentials are Invalid!');
        }
    }
    public function admindashboard()
    {
        return view('backend.dashboard');
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    /*Profile*/
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.admin.profile', compact('admin'));
    }
    //Change Password
    public function changePassword()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.admin.change-password', compact('admin'));
    }
    public function submitChangePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        $ok = Admin::find($request->id);
        $password = $request->input('current_password');
        $check = Admin::where('id', $request->id)->first();
        if (Hash::check($password, $check->password)) {
            if ($request->password == $request->confirm_password) {
                $ok->password = bcrypt($request->password);
                $ok->save();
                return back()->withSuccess('Password Change Successful');
            }
            return back()->withErrors('New Password & Confirm Password Not Match!');
        } else {
            return back()->withErrors('Current Password Not Match');
        }
    }
}
