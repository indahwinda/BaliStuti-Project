<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompanyController extends Controller
{
    public function index()
    {
        $title = "Profile";
        $active = "profile";
        $profile = User::find(Auth::user()->id);
        $company = Company::find(1);
        return view('admin.profile.index', compact('profile','title', 'active', 'company'));
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
    public function updateCompany(Request $request)
    {
        $request->validate( [
            'cname' => 'required',
            'cemail' => 'required|email',
            'cphone' => 'required|numeric',
            'caddress' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'cdescription' => 'required'
        ],
        [
            'cname.required' => 'Company name is required',
            'cemail.required' => 'Company email is required',
            'cemail.email' => 'Company email is invalid',
            'cphone.required' => 'Company phone is required',
            'cphone.numeric' => 'Company phone is invalid',
            'caddress.required' => 'Company address is required',
            'facebook.required' => 'Company facebook is required',
            'twitter.required' => 'Company twitter is required',
            'instagram.required' => 'Company instagram is required',
            'cdescription.required' => 'Company description is required'
        ]);
        $company = Company::find($request->cid);
        if($request->hasFile('cimage'))
        {
            $path = public_path().'/assets/logo/'.$company->logo;
            if(file_exists($path))
            {
                unlink($path);
            }
            $file = $request->file('cimage');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'_'.uniqid().'.'.$ext;
            $file->move('assets/logo',$filename);
            $company->logo = $filename;
        }
        $company->name = $request->cname;
        $company->email = $request->cemail;
        $company->phone = $request->cphone;
        $company->address = $request->caddress;
        $company->facebook = str_replace("https:","",$request->facebook);
        $company->twitter = str_replace("https:","",$request->twitter);
        $company->instagram = str_replace("https:","",$request->instagram);
        $company->description = $request->cdescription;
        $company->save();
        return redirect()->back()->with('status', 'Company information updated successfully');
    }
}
