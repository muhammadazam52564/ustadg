<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard');
    }

    public function categories(Request $request)
    {
        return view('admin.categories');
    }

    public function category(Request $request)
    {
        return view('admin.categories');
    }

    public function sub__categories(Request $request)
    {
        return view('admin.sub__categories');
    }

    public function sub__category(Request $request)
    {
        return view('admin.categories');
    }

    public function services(Request $request)
    {
        return view('admin.services');
    }

    public function service(Request $request)
    {
        return view('admin.categories');
    }

    public function change_password(Request $request)
    {
        return view('admin.changePassword');
    }

    public function update_password(Request $request)
    {
        if (Hash::check($request->curr__password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new__password);
            if($user->save())
            {
                return Redirect::back()->with('msg', 'Password updated Successfully');
            }


        }
    }
    public function change_email(Request $request)
    {
        return view('admin.changeEmail');
    }

    public function update_email(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->email = $request->email;
            if($user->save())
            {
                return Redirect::back()->with('msg', 'Password updated Successfully');
            }


        }
    }
}
