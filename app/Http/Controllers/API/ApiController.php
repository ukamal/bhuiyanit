<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SupplierResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getProducts($type){
        return ProductResource::collection(Product::where('product_type',$type)->get());
    }

    public function getProduct($id){
        return new ProductResource(Product::find($id));
    }

    function order_no(){
        $order = Order::orderBy('id','DESC')->first();
        if($order){
            $order_no=$order->order_no+1;
            return $order_no;
        }else{
            $order_no=10001;
            return $order_no;
        }
    }
    
    public function customers(){
       
        return  CustomerResource::collection(Customer::orderBy('id','desc')->get());

    }

    public function customerStore(Request $request){
        $data=[
            'customer'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email
        ];
        $customer = Customer::create($data);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function customerShow($id){

        return new CustomerResource(Customer::find($id));
    }


    public function suppliers(){
       
        return  SupplierResource::collection(Supplier::orderBy('id','desc')->get());

    }

    public function supplierStore(Request $request){
        $data=[
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email
        ];
        $supplier=Supplier::create($data);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function supplierShow($id){

        return new SupplierResource(Supplier::find($id));
    }

}
