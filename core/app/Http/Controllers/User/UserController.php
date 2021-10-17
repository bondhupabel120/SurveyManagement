<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Image;
use Auth;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('user.user.login');
    }
    public function loginCheck(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]) || Auth::guard('web')->attempt([
            'phone' => $request->email,
            'password' => $request->password
        ]) || Auth::guard('web')->attempt([
            'user_id' => $request->email,
            'password' => $request->password
        ])) {
            LoginHistory::create([
                'user_id' => Auth::guard('web')->user()->id,
                'login' => Carbon::now(),
            ]);
            return redirect()->route('user.dashboard');
        }
        return back()->with('message', 'The Combination of Username or Password is Wrong!.')->withErrors('The Combination of Username or Password is Wrong!.');
    }
    public function userDashboard()
    {
        $user = Auth::guard()->user();
        return view('user.dashboard', compact('user'));
    }
    public function userLogout()
    {
        $user_id = LoginHistory::where('user_id', Auth::guard('web')->user()->id)->whereNull('logout')->latest()->first();
        if ($user_id != '') {
            $user_id->logout = Carbon::now();
            $user_id->save();
            Auth::guard('web')->logout();
        } else {
            Auth::guard('web')->logout();
        }
        return redirect()->route('user.login');
    }

    /*Profile*/
    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('user.user.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find($request->id);
        $this->validate($request, [
            'first_name' => 'required',
            'address' => 'required',
        ]);
        if ($request->hasFile('image')) {
            @unlink($user->image);
            $image = $request->file('image');
            $filename = $image->hashName();
            $location = 'assets/backend/images/user/' . $filename;
            Image::make($image)->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $user->image = $location;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->profession = $request->profession;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->save();
        return back()->withSuccess('Update Successfully');
    }

    //Change Password
    public function changePassword()
    {
        $user = Auth::guard('web')->user();
        return view('user.user.change-password', compact('user'));
    }
    public function submitChangePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        $ok = User::find($request->id);
        $password = $request->input('current_password');
        $check = User::where('id', $request->id)->first();
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
