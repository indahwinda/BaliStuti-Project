<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomProductController extends Controller
{
   public function index()
   {
    return view('frontend.request');
    }
}