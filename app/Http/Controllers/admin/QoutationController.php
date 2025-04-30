<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Qoutation;
use App\Models\QoutationProduct;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QoutationController extends Controller
{
    public function index(){
        $products = Product::all();
        $customers = Customer::all();
        return view('admin.qoutation.index',compact('products','customers'));
    }

    public function list(){
        $sales = Qoutation::all();
        return view('admin.qoutation.sale_list',compact('sales'));
    }

    public function qoutation_details($sale_id){
        $order = Qoutation::where('id',$sale_id)->first();
        return view('admin.qoutation.sale_details',compact('order'));
    }
     public function qoutation_details_print($sale_id){
        $order = Qoutation::where('id',$sale_id)->first();
        return view('admin.qoutation.sale_details_pdf',compact('order'));
    }

    public function store(Request $request)
    {

        $data=[
            'qoutation_no'=>$request->qoutation_no,
            'user_id'=>Auth::user()->id,
            'sale_date'=>$request->qoutation_date,
            'customer_id'=>$request->customer,
            'customer_address'=>$request->customer_address,
            'customer_mobile'=>$request->customer_mobile,
            'subject'=>$request->sub,
            'dsc'=>$request->dsc,

        ];
        $sale=Qoutation::create($data);
        if($sale){
            if(count($request->rate)>0){
               $productLength = count($request->rate);
                for($i=0;$i<$productLength;$i++){
                    QoutationProduct::create([
                        'qoutation_id'=>$sale->id,
                        'item_dsc'=>$request->item_dsc[$i],
                        'unit'=>$request->unit[$i],
                        'rate'=>$request->rate[$i],
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    /********Start Item Qoutation*********/
    public function itemQoutationAdd(){
        $products = Product::all();
        $customers = Customer::all();
        return view('admin.qoutation.add_item_qutation',compact('products','customers'));
    }

    public function itemQutationStore(Request $request){
        dd($request->all());
        
    }
}
