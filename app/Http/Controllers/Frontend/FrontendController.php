<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class FrontendController extends Controller
{
   public function index()
   {
      $category = Categories::where('status', 1)->get();
      $featured_pro = Product::where('status', 1)->where('trending', 1)->take(8)->get();
      $new_pro = Product::where('status', 1)->where('created_at', '>=', date('Y-m-d', strtotime('-30 days')))->take(8)->get();
      
      $product =  \RecentlyViewed\Facades\RecentlyViewed::get(Product::class,4);
      $company = Company::find(1);
      return view('frontend.index', compact('category', 'featured_pro', 'new_pro', 'product', 'company'));
   }
   public function viewcategory($slug){
      $category = Categories::where('status', 1)->get();
      if(Categories::where('slug', $slug)->exists())
      {  
         $cate= Categories::where('slug', $slug)->first();
         $product = Product::where('cate_id',$cate->id)->paginate();
         return view('frontend.products',compact('product','cate','category'));
      }
      else{
         return view('frontend.products',compact('category'))->with('status', "Slug doesn't exist");
      }
   }
   public function products()
   {
      $cate = 0;
      $product = Product::where('status', 1)->orderBy('id','desc')->paginate(5);
      $category = Categories::where('status', 1)->get();
      // return view('frontend.products',compact('product'));
      if(request('search')){
         $product = Product::where('name', 'like', '%'. request('search').'%')->paginate();
      }
      return view('frontend.products',compact('product','category'));
   }
   public function product_detail($id)
   {
      
      $product = Product::find($id);
      $category = new Categories;
      $gallery = $product->images;
      // session()->push('products.recently_viewed', $product->getKey());
      \RecentlyViewed\Facades\RecentlyViewed::add($product);
      // dd($product);
      //get user id in order 
      $user_id = Auth::id();
      $order = Order::where('user_id', $user_id)->where('status', 1);
      $reviews = Review::where('product_id', $id)->get();

      //check if user already purchased this product
      $purchased = false;
      if(Auth::check()){
         $count = $order->whereHas('orderItems', function($query) use ($id){
            $query->where('product_id', $id);
         })->count();
         if ($count>0) {
            $purchased = true;
         }
      }
      
      //check if user already review this product
      $reviewed = false;
      if(Auth::check()){
         $count = Review::where('user_id', $user_id)->where('product_id', $id)->count();
         if ($count>0) {
            $reviewed = true;
         }
      }
      
      return view('frontend.product_detail',compact('reviewed','product', 'category', 'gallery', 'reviews', 'purchased'));
   }
   public function about()
   {
      return view('frontend.about');
   }

   public function filter_price(Request $request)
   {
      $category = Categories::where('status', 1)->get();
      $cate = 0;
      $product = $this->filterByPrice(
         Product::where('status', 1)->orderBy('id','desc'),
         [$request->min ?: 0, $request->max ?: 0]);
      return view('frontend.products',compact('product','category','cate'));
   }

   public function filterByPrice( $query, $range)
   {
     
    if (!$range[0] && !$range[1]) return $query->paginate(5);
    
    if ($range[0] && !$range[1]) {
        return $query
            ->where('selling_price', '>=', $range[0])
            ->paginate(5);
    }

    if (!$range[0] && $range[1]) {
        return $query
            ->where('selling_price', '<=', $range[1])
            ->paginate(5);
    }

    return $query
        ->whereBetween('selling_price', $range)
        ->paginate(5);
   }

   public function postReview(Request $request)
   {
      $request->validate([
         'product_id' => 'required',
         'message' => 'required',
      ]);
      $review = new Review();
      $review->user_id = Auth::user()->id;
      $review->message = $request->input('message');
      $review->product_id = $request->input('product_id');
      $review->save();
      return redirect()->back()->with('status', 'Review added successfully');
   }
   
}
