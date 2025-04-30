<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ServiceSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ServiceSaleController extends Controller
{
    //index
    public function index(){
        $products = Product::all();
        $customers = Customer::all();
        $brands = Brand::all();
        return view('admin.service_sale.index',compact('products','customers','brands'));
    }
    //store
    public function store(Request $request){
        $invoiceDate = $request->input('invoice_date');
        $serviceSaleNo = $request->input('service_sale_no');
        $customerId = $request->input('customer_id');
        $brand_name = $request->input('brand_name');
        $model = $request->input('model');
        $chasis_no = $request->input('chasis_no');
        $mobile = $request->input('mobile');
        $dsc = $request->input('dsc');
        $grand_total = $request->input('grand_total',[]);

    
        // Assuming that item_dsc, unit, rate, and total are arrays
        $itemDescriptions = $request->input('item_dsc', []);
        $units = $request->input('unit', []);
        $rates = $request->input('rate', []);
        $totals = $request->input('total', []);
    
        // Assuming they have the same number of elements
        $count = count($itemDescriptions);
    
        for ($i = 0; $i < $count; $i++) {
            $service_sale = new ServiceSale();
            $service_sale->invoice_date = $invoiceDate;
            $service_sale->service_sale_no = $serviceSaleNo;
            $service_sale->customer_id = $customerId;
            $service_sale->brand_name = $brand_name;
            $service_sale->model = $model;
            $service_sale->chasis_no = $chasis_no;
            $service_sale->mobile = $mobile;
            $service_sale->item_dsc = $itemDescriptions[$i];
            $service_sale->unit = $units[$i];
            $service_sale->rate = $rates[$i];
            $service_sale->total = $totals[$i];
            $service_sale->dsc = $dsc;
            $service_sale->grand_total = $grand_total[$i];
            $service_sale->save();
        }
    
        if(isset($service_sale)){
            Toastr::success('Service Sale Created Successfully');
        }
        
        return redirect()->back();
    }
    //list
    public function list(){
        $service_sale = ServiceSale::all();
        return view('admin.service_sale.list',compact('service_sale'));
    }
    //details
    public function details($id){
        $service_sale = ServiceSale::find($id);
        return view('admin.service_sale.details',compact('service_sale'));
    }
    //print
    public function pdf($id){
        $service_sale = ServiceSale::find($id);
        return view('admin.service_sale.pdf',compact('service_sale'));
    }

    public function serviceSaleRemove($id){
        ServiceSale::find($id)->delete();
        return redirect()->back();
    }
    
}
