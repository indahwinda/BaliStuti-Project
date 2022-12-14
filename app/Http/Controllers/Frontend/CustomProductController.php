<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Company;
use App\Models\CustomProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomProductController extends Controller
{
    public function index()
    {
        return view('frontend.request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);


        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/custom'), $image_name);

        $custom = new CustomProduct();
        $custom->name = $request->input('name');
        $custom->user_id = auth()->user()->id;
        $custom->description = $request->input('description');
        $custom->image = $image_name;
        $custom->status = 'requested';
        $custom->save();

        return redirect()->back()->with('status', 'Your request has been sent successfully');
    }

   
}