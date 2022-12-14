<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class HistoryController extends Controller
{
    public function index()
    {
       $active = "history";
       $title= "History Orders";
       $orders = Order::orderBy('updated_at', 'desc')->get();
       return view('admin.history.history',['title' =>$title,'active'=>$active,'orders'=>$orders]);
    }
    public function viewOrder($id)
    {
       $active = "orders";
       $title= "Orders";
       $orders = Order::find($id);
       return view('admin.list-orders.view',['title' =>$title,'active'=>$active,'orders'=>$orders]);
    }
     
}
