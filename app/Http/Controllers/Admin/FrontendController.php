<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function index()
   {
    $active = "dashboard";
    $title= "Dashboard";
   //  $notifications = auth()->user()->unreadNotifications;
   //  $count = auth()->user()->unreadNotifications()->where('data->name', '<>', auth()->user()->name)->count();compact('notifications','count'), 
    return view('admin.index',['title' =>$title,'active'=>$active ]);
   }

   public function markNotification(Request $request)
   {
      auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
         return $query->where('id', $request->input('id'));
      })->markAsRead();

      return response()->noContent();
   }
}
