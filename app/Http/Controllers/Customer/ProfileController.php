<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "Profile";
        $active = "profile";
        $profile = User::find(Auth::user()->id);
        return view('customer.profile.index', compact('profile','title', 'active'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);
        $profile = User::find(Auth::user()->id);
        if($request->hasFile('image'))
        {
            $path = public_path().'/assets/img_profile/'.$profile->img_profile;
            if(file_exists($path) && $profile->img_profile != 'default_dp.png')
            {
                unlink($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'_'.uniqid().'.'.$ext;
            $file->move('assets/img_profile',$filename);
            $profile->img_profile = $filename;
        }
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->save();
        return redirect()->back()->with('status', 'Profile updated successfully');
    }
}
