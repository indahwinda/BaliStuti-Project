<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\Handler;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Gallery;
use Exception;

class ProductController extends Controller
{
    public function index(){
        $active = "product";
        $title= "Product";
        $product = Product::all();
        $category = Categories::all();
        return view('admin.product.index',compact('product','category'), ['title' =>$title,'active'=>$active ]);

    }
    public function add(){
        $active = "product";
        $title= "Product";
        $category = Categories::all();
        return view('admin.product.add', compact('category'),['title' =>$title,'active'=>$active ]);
    }
    
    public function insert(Request $request){
        $product = new Product();
        $data = $request->validate([
            'cate_id' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'original_price' => 'required', 
            'selling_price' => 'required', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'gallery' => 'required',
            'qty' => 'required|numeric', 
            'weight' => 'required|numeric',
            'tax' => 'required|numeric', 
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);
        $price_ori = str_replace(['Rp','.'], "", $request->input('original_price'));
        $price_sell = str_replace(['Rp','.'], "", $request->input('selling_price'));
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/upload/product',$filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $price_ori;
        $product->selling_price = $price_sell;
        $product->qty = $request->input('qty');
        $product->weight = $request->input('weight');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE? '1':'0';
        $product->trending = $request->input('trending') == TRUE? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->save();
        if($request->hasFile('gallery'))
        {
           foreach($request->file('gallery') as $gallery)
           {
               $imageName = $product->id.'-image-'.time().rand(1,1000).'.'.$gallery->extension();
               $gallery->move('assets/upload/gallery',$imageName);
               Gallery::create([
                   'product_id'=> $product->id,
                   'image' => $imageName,
               ]);
           }
        }
        return redirect('/products')->with('status',"Product Added");
    }
    public function update(Request $request){
        $id = $request->input('id');
        $product = Product::find($id);
        $request->validate([
            'cate_id' => 'required',
            'slug' => 'required|alpha',
            'name' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'original_price' => 'required', 
            'selling_price' => 'required', 
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'qty' => 'required|numeric', 
            'weight' => 'required|numeric',
            'tax' => 'required|numeric', 
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);
        $price_ori = str_replace(['Rp','.'], "", $request->input('original_price'));
        $price_sell = str_replace(['Rp','.'], "", $request->input('selling_price'));
        if($request->hasFile('image'))
        {
            $path = public_path().'/assets/upload/product/'.$product->image;
            if(file_exists($path))
            {
                unlink($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/upload/product',$filename);
            $product->image = $filename;
        }
        if($request->hasFile('gallery'))
        {
            //delete old img and delete image data on table
            foreach($product->images as $item){
                $path = public_path().'/assets/upload/gallery/'.$item->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
                Gallery::where('product_id', $id)->delete();
            }
            //update with new image and table
           foreach($request->file('gallery') as $gallery)
           {
               $imageName = $id.'-image-'.time().rand(1,1000).'.'.$gallery->extension();
               $gallery->move('assets/upload/gallery',$imageName);
               Gallery::create([
                'product_id'=> $id,
                'image' => $imageName,
            ]);
           }
        }
        try {
            $product->cate_id = $request->input('cate_id');
            $product->name = $request->input('name');
            $product->slug = $request->input('slug');
            $product->small_description = $request->input('small_description');
            $product->description = $request->input('description');
            $product->original_price = $price_ori;
            $product->selling_price = $price_sell;
            $product->qty = $request->input('qty');
            $product->weight = $request->input('weight');
            $product->tax = $request->input('tax');
            $product->status = $request->input('status') == TRUE? '1':'0';
            $product->trending = $request->input('trending') == TRUE? '1':'0';
            $product->meta_title = $request->input('meta_title');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->meta_description = $request->input('meta_description');
            $product->update();
            return redirect('/products')->with('status',"Product Updated");
        }catch(Exception $e){
            return redirect('/products')->with('error',"Failed to update, please try again!");
        }

    }
    public function gallery($id)
    {
        $active = "product";
        $title= "Gallery Product";
        $product = Product::find($id);
        if(!$product) abort(404);
        $gallery = $product->images;
        return view('admin.product.gallery', compact('product', 'gallery','title','active'));
    }
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);
        if($product->image)
        {
            $path = public_path().'/assets/upload/product/'.$product->image;
            if(file_exists($path))
            {
                unlink($path);
            }
        }
        if($product->images)
        {
            //delete old img and delete image data on table
            foreach($product->images as $item){
                $path = public_path().'/assets/upload/gallery/'.$item->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
                Gallery::where('product_id', $id)->delete();
            }
        }
        try {
            $product->delete();
            return redirect('/products')->with('delete',"Product #".$id." deleted");
        } catch (Handler $th) {
            return redirect('/products')->with('error',"Failed to delete product #".$id.".");
        }
    }
}
