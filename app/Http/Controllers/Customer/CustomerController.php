<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Order;
use App\Models\User;
use App\Notifications\UserOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
   public function index()
   {
    $active = "dashboard";
    $title= "Dashboard";
    return view('customer.index', compact('title','active'));
   }
   public function notify()
   {
      
   }
   public function my_orders()
   {
      $active = "my_orders";
      $title= "My Orders";
      $orders = Order::where('user_id', auth()->user()->id)->get();
      return view('customer.my_orders.index', compact('orders', 'title', 'active'));
   }
   public function viewOrder($id)
   {
      $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
      $active = "my_orders";
      $title= "My Orders";
      return view('customer.my_orders.view', compact('orders', 'title', 'active'));
   }
}
