<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Notifications\UserOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::id())->get();
        $provinces = Province::pluck('name', 'province_id');
        foreach($old_cartItems as $item)
        {
            $itemQty = Product::where('id', $item->product_id)->first();
            if($itemQty->qty < $item->product_qty)
            {
                $removeItem = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->product_id)->first();
                $removeItem->delete();   
                return redirect()->back()->with('error', 'Product quantity is not enough');
            }
        }
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.checkout', compact('provinces', 'cartItems'));
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request)
    {
        $c1 = RajaOngkir::ongkosKirim([
            'origin'        => "114", // ID kota/kabupaten asal denpasar
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => "jne" // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        $c2 = RajaOngkir::ongkosKirim([
            'origin'        => "114", // ID kota/kabupaten asal denpasar
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => "tiki" // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        $c3 = RajaOngkir::ongkosKirim([
            'origin'        => "114", // ID kota/kabupaten asal denpasar
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => "pos" // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        $cost =(object) array_merge_recursive($c1, $c2, $c3);
        return response()->json($cost);
    }
    public function placeOrder(Request $request)
    {
        $validation =  $request->validate([
            'name' => 'required',
            'address' => 'required',
            'province_destination' => 'required',
            'city_destination' => 'required',
            'pos_code' => 'required',
            'phone' => 'required',
            'courier' => 'required',
            'courier_ongkos' => 'required',
        ]);
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->name = $request->input('name');
        $cities = City::where('city_id', $request->input('city_destination'))->first();
        $province = Province::where('province_id', $request->input('province_destination'))->first();
        $order->address = $request->input('address');
        $order->province = $province->name;
        $order->cities = $cities->name;
        $order->phone = $request->input('phone');
        $order->pos_code = $request->input('pos_code');
        $order->courier = $request->input('courier');
        $order->courier_ongkos = $request->input('courier_ongkos');
        $order->total = $request->input('total_orders');
        $order->tracking_no = 'stuti'.rand(1111,9999);
        $order->save();    
        

        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        foreach($cartItems as $item)
        {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->qty = $item->product_qty;
            $orderItem->price = $item->product->selling_price;
            $orderItem->save();

            $product = Product::find($item->product_id);
            $product->qty = $product->qty - $item->product_qty;
            $product->update();
        }
        if(Auth::user()->address == null && Auth::user()->phone == null)
        {
            $user = Auth::user();
            $user->address = $request->input('address').','.$cities->name.','.$province->name.','.$request->input('pos_code');
            $user->phone = $request->input('phone');
            $user->save();
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        if(auth()->user())
        {
            $user = User::find(auth()->user()->id);
            $admin = User::find(1);
            $admin->notify(new UserOrderNotification($user));
            
            $details = [
                'title' => 'Order Confirmation',
                'body' => 'Order Confirmation',
                // 'url' => url('my-order/'.$order->id),
            ];

            \Mail::to(auth()->user()->email)->send(new \App\Mail\EmailNotif($details));
    
        }
        return response()->json(['success' => 'Order Successfully Placed']);
    }
    

    
}
