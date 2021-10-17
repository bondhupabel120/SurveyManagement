<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Libraries\CommonFunction;
use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use DB;
use Image;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /* User Add Section */
    public function addUser()
    {
        $title = 'Add User';
        return view('backend.user.add-user', compact('title'));
    }
    public function saveUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required|unique:users|max:11|min:11',
        ]);
        $user_id = Carbon::now()->format('Ymdhis');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();
            $location = 'assets/backend/images/user/' . $filename;
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
        }
        User::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'image' => $request->hasFile('image') ? $location : null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->status,
        ]);
        // $reciever = $request->email;
        // $name = $request->first_name;
        // $email = $request->email;
        // $password = $request->password;
        // $phone = $request->phone;
        // $hostName = \Request::getHost();
        // $url = 'https://'.$hostName.'/user';
        // SendMailFunction::SendMail($reciever, $name, $email, $password, $phone, $url);
        return back()->withSuccess('Add Successful');
    }
    public function manageUser()
    {
        return view('backend.user.manage-user');
    }

    public function getUser(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = User::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('image', function ($list) {
                    if ($list->image) {
                        return '<a href="' . '/' . $list->image . '" target="_blank"><img src="' . '/' . $list->image . '" alt="Image" style="max-height: 50px"/></a>';
                    } else {
                        return null;
                    }
                })
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('edit.user', ['id' => $list->id]) .
                        '" class="btn btn-primary btn-xs pl-1 pr-1"> <i class="fa fa-folder-open"></i> Edit </a> <a style="padding:2px; font-size:15px; color: #fff" class="btn btn-danger btn-xs pl-1 pr-1" id="' . $list->id . '" onClick="deleteUser(this.id,event)"> <i class="fas fa-trash"></i> Delete </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'image', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }
    public function editUser($id)
    {
        $user = User::findorFail($id);
        return view('backend.user.edit-user', compact('user'));
    }
    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $this->validate($request, [
            'name' => 'required',
            'phone' =>  $request->phone != $user->phone ? 'required|unique:users,phone|min:11,max:11' : 'required|max:11,min:11',
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
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        return back()->withSuccess('Update Successfully');
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user != null) {
            @unlink($user->image);
            $user->delete();
        }
        return response()->json('success');
    }

    /* User Track */
    public function adminUserTrack()
    {
        return view('backend.user.user-track');
    }

    public function getUserTrack(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = User::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('survey', function ($list) {
                    $survey = DB::table('user_questions')->where('created_by', $list->id)->count();
                    return '<a style="padding:2px;font-size:15px;" target="_blank" href="' . route('admin.view.user.servey', ['id' => $list->id]) .
                        '" class="btn btn-primary text-white btn-xs pr-2 pl-2"> <i class="fa fa-eye"></i> Total Survey (' . $survey . ') </a>';
                })
                ->addColumn('login_history', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('admin.view.login.history', ['id' => $list->id]) . ' " target="_blank" class="btn btn-primary text-white pr-2 pl-2"><span class="fa fa-lock"></span> Login History</a>';
                })
                ->addIndexColumn()
                ->rawColumns(['survey', 'login_history'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function viewLoginHistory($id)
    {
        return view('backend.user.view-login-history', compact('id'));
    }
    public function getUserLoginHistory(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = LoginHistory::where('user_id', $request->id)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('name', function ($list) {
                    if ($list->user_id) {
                        return '<td>' . $list->userName->name . '</td>';
                    } else {
                        return null;
                    }
                })
                ->editColumn('phone', function ($list) {
                    if ($list->user_id) {
                        return '<td>' . $list->userName->phone . '</td>';
                    } else {
                        return null;
                    }
                })
                ->editColumn('login', function ($list) {
                    return Carbon::parse($list->login)->format('d M Y') . '<br>' .
                        (Carbon::parse($list->login)->format('H:i A'));
                })
                ->addColumn('logout', function ($list) {
                    if ($list->logout) {
                        return Carbon::parse($list->logout)->format('d M Y') . '<br>' .
                            (Carbon::parse($list->logout)->format('H:i A'));
                    } else {
                        return 'Session Logout';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['phone', 'name', 'login', 'logout'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function viewUserServey($id)
    {
        return view('backend.user.view-user-survey', compact('id'));
    }

    public function getUserServey(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = UserQuestion::where('created_by', $request->id)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('userName', function ($list) {
                    if ($list->created_by) {
                        return '<td>' . $list->userName->name . '</td>';
                    } else {
                    }
                })
                ->editColumn('date', function ($list) {
                    return Carbon::parse($list->created_at)->format('d M Y');
                })
                ->editColumn('time', function ($list) {
                    return Carbon::parse($list->created_at)->format('h:i A');
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('view.survey', ['id' => $list->id, 'user_id' => $list->created_by]) . '" class="btn btn-primary text-white pl-2 pr-2"> <span class="fas fa-eye"></span> Show Data </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['userName', 'date', 'time', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }
}
