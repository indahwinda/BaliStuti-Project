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
   public function __construct()
   { 
      // IDR to USD rate
      $apikey = env('CURRENCY_API_KEY');
      $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey={$apikey}");
      $obj = json_decode($json, true);

      $this->val = floatval($obj["IDR_USD"]);
   }
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
      $USD = $this->val;
      return view('customer.my_orders.index', compact('orders', 'title', 'active', 'USD'));
   }
   public function viewOrder($id)
   {
      $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
      $active = "my_orders";
      $title= "My Orders";
      return view('customer.my_orders.view', compact('orders', 'title', 'active'));
   }

   public function request_product()
   {
      $active = "request_product";
      $title= "Request Product";
      return view('customer.request_product.index', compact('title','active'));
   }
}
