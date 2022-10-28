<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\Handler;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index(){
        $active = "category";
        $title= "Category";
        $notifications = auth()->user()->unreadNotifications;
        $category = Categories::all();
        return view('admin.category.index',compact('category','notifications'), ['title' =>$title,'active'=>$active ]);

    }
    public function add(){
        $active = "category";
        $title= "Category";
        return view('admin.category.add',['title' =>$title,'active'=>$active ]);
    }
    public function insert(Request $request){
        $category = new Categories();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'slug' => 'required|alpha',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/upload/category',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE? '1':'0';
        $category->popular = $request->input('popular') == TRUE? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->save();
        return redirect('/categories')->with('status',"Category Added");
    }
    public function update(Request $request){
        $id = $request->input('id');
        $category = Categories::find($id);
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'slug' => 'required|alpha',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);
        if($request->hasFile('image'))
        {
            $path = public_path().'/assets/upload/category/'.$category->image;
            if(file_exists($path))
            {
                unlink($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/upload/category',$filename);
            $category->image = $filename;
        }
        try {
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == TRUE? '1':'0';
            $category->popular = $request->input('popular') == TRUE? '1':'0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_keywords = $request->input('meta_keywords');
            $category->meta_description = $request->input('meta_description');
            $category->update();
            return redirect('/categories')->with('status',"Category Updated");
        }catch(Handler $e){
            return redirect('/categories')->with('error',"Failed to update, please try again!");
        }

    }
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $category = Categories::find($id);
        if($category->image)
        {
            $path = public_path().'/assets/upload/category/'.$category->image;
            if(file_exists($path))
            {
                unlink($path);
            }
        }
        try {
            $category->delete();
            return redirect('/categories')->with('delete',"Category #".$id." deleted");
        } catch (Handler $th) {
            return redirect('/categories')->with('error',"Failed to delete category #".$id.".");
        }
    }
}
