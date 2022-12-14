<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function listOrders()
   {
      $active = "orders";
      $title= "Orders";
      $orders = Order::where('status',0)->orderBy('id', 'desc')->get();
      return view('admin.list-orders.index',['title' =>$title,'active'=>$active,'orders'=>$orders]);
   }
   public function viewOrder($id)
   {
      $active = "orders";
      $title= "Orders";
      $orders = Order::find($id);
      return view('admin.list-orders.view',['title' =>$title,'active'=>$active,'orders'=>$orders]);
   }
   public function updateOrder(Request $request)
   {
      $id = $request->id;
      $order = Order::find($id);
      $request->validate([
         'status' => 'required',
      ]);
      $status = $request->status;
      if($status == 3)
      {
         $request->validate([
            'note' => 'required',
         ]);
         $order->message = $request->note;
         $order->status = $status;
         $order->update();
         return redirect()->back()->with('status', 'Order status updated successfully');
      }
      elseif($status == 4)
      {
         $request->validate([
            'tracking_no' => 'required',
         ]);
         $order->status = $status;
         $order->tracking_no = $request->tracking_no;
         $order->update();
         return redirect()->back()->with('status', 'Order status updated successfully');
      }
      else
      {
         $order->status = $status;
         $order->update();
         return redirect()->back()->with('status', 'Order status updated successfully');
      }
      if (!$order->update()) {
         return redirect()->back()->with('error', 'Something went wrong');
      }
   }
}
