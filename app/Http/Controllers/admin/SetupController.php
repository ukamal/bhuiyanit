<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\GlassProduct;

class SetupController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard.dashboard');
    }
    public function get_supplier_info($id){
       $supplier = Supplier::where('id',$id)->first();
       return response()->json($supplier);
    }

    public function get_customer_info($id){
       $customer= Customer::where('id',$id)->first();

       return response()->json($customer);
    }

   //  public function get_glass_product_info($id){
   //      $glass_product = GlassProduct::find($id);
 
   //      return response()->json($glass_product);
   //   }
}
