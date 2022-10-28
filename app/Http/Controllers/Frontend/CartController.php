<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function addProduct(Request $request)
   {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $product_check = Product::where('id', $product_id)->first();
            if($product_check)
            {
                if(Cart::where("product_id",$product_id)->where("user_id",Auth::user()->id)->exists())
                {
                    return response()->json(['error' => $product_check->name.' already in cart']);
                }
                else
                {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->user_id = Auth::user()->id;
                    $cartItem->save();
                    return response()->json(['success' => $product_check->name.' added to cart successfully!']);
                }
            }
        }
        else
        {
            return response()->json(['error' => 'You must login to add product to cart']);
        }
   }
   public function viewCart()
   {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.cart', compact('cartItems'));
   }
   public function deleteItem(Request $request)
   {
       if(Auth::check())
       {
           $product_id = $request->input('product_id');
           if(Cart::where('product_id',$product_id)->where('user_id',Auth::user()->id)->exists())
           {
               Cart::where('product_id',$product_id)->where('user_id',Auth::user()->id)->delete();
               return response()->json(['success' => 'Product deleted from cart successfully!']);
           }
           else
           {
               return response()->json(['error' => 'Product not found in cart']);
           }
       }
       else
         {
              return  response()->json(['error' => 'You must login to add product to cart']);
         }
   }
   public function updateCartItem(Request $request)
   {
         if(Auth::check())
         {
              $product_id = $request->input('product_id');
              $product_qty = $request->input('product_qty');
              if(Cart::where('product_id',$product_id)->where('user_id',Auth::user()->id)->exists())
              {
                Cart::where('product_id',$product_id)->where('user_id',Auth::user()->id)->update(['product_qty' => $product_qty]);
                return response()->json(['success' => 'Product quantity updated successfully!']);
              }
              else
              {
                return response()->json(['error' => 'Product not found in cart']);
              }
         }
         else
         {
              return response()->json(['error' => 'You must login to add product to cart']);
         }
   }
}
