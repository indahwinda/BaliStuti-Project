<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomProduct;
use Illuminate\Http\Request;

class CustomProductController extends Controller
{
    public function __construct()
    { 
       // IDR to USD rate
       $apikey = env('CURRENCY_API_KEY');
       try {
          $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey=$apikey");
          //if failed to get data from api, use default rate
       
          $obj = json_decode($json, true);
          $this->val = floatval($obj["IDR_USD"]);
       } catch (\Throwable $th) {
          $this->val = 0.000071;
       }
       
    }
    public function index()
    {
        $active = "customs";
        $title= "Custom Products";
        $customs = CustomProduct::all();
        $USD = $this->val;
        return view('admin.custom.index', compact('customs', 'title', 'active', 'USD'));
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $custom = CustomProduct::find($id);
        $request->validate([
            'status' => 'required',
        ]);
        $status = $request->status;
        if($status == 'rejected')
        {
            $request->validate([
                'note' => 'required',
            ]);
            $custom->message = $request->note;
            $custom->status = $status;
            $custom->update();
            return redirect()->back()->with('status', 'Custom product status updated successfully');
        }
        else if($status == 'accepted')
        {
            $custom->status = $status;
            $custom->update();
            return redirect()->back()->with('status', 'Custom product status updated successfully');
        }
        else if ($status == 'pending')
        {
            $custom->status = $status;
            $custom->update();
            return redirect()->back()->with('status', 'Custom product status updated successfully');
        }
      
        else
        {
            return redirect()->back()->with('error', 'Invalid status');
        }
        if (!$custom->update()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function updateLink(Request $request)
    {
        $id = $request->id;
        $custom = CustomProduct::find($id);
        $request->validate([
            'product_link' => 'required',
        ]);
        $custom->product_link = $request->product_link;
        $custom->update();
        return redirect()->back()->with('status', 'Custom product link updated successfully');
    }

}
