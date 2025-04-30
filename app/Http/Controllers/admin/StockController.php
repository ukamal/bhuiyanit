<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\StockProduct;
use Illuminate\Http\Request;
use App\Models\OrderGlassProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function stock()
    {
        $products = Product::all();
        return view('admin.stock.index', compact('products'));
    }

    public function glass_stock_search(Request $request){

        dd('Glass Order Search');
        $glassOrder = Order::where('order_type','Glass')->where('order_no',$request->glass_order_no)->first();
        if(isset($glassOrder)){
            $glass_order_id =  $glassOrder->id;
            $glass_order_products = OrderGlassProduct::where('order_id',$glass_order_id)->get();
            // Ekhan theke shuru hobe
        }
    }

    public function order_get($order_no)
    {
        $products = Product::all();
        $order = Order::where('order_no', $order_no)->first();
        return view('admin.stock.product_table', compact('products', 'order'));
    }

    public function stock_store(Request $request)
    {

        if (count($request->product_id) > 0) {
            $productLength = count($request->product_id);
            for ($i = 0; $i < $productLength; $i++) {
                StockProduct::create([
                    'order_id' => $request->order_id,
                    'product_id' => $request->product_id[$i],
                    'silver_rate' => $request->silver_rate[$i],
                    'silver_qty' => $request->silver_qty[$i],
                    'bronze_rate' => $request->bronze_rate[$i],
                    'bronze_qty' => $request->bronze_qty[$i],
                    'ss_rate' => $request->ss_rate[$i],
                    'ss_qty' => $request->ss_qty[$i],
                    'other_rate' => $request->other_rate[$i],
                    'other_qty' => $request->other_qty[$i],
                ]);
            }
        }
        return redirect()->back();
    }

    // public function stock_list(){
    //     $products=Product::all();
    //     return view('admin.stock.stock_list', compact('products'));
    // }


    public function stock_list(){
        $products=Product::orderBy('id','desc')->get();
        // return response()->json($products);
        return view('admin.stock.stock_list1', compact('products'));
    }


}
