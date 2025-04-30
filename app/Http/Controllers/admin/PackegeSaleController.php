<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Customer;
use App\Models\PackegeSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PackegeSaleController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $package = Package::all();
        return view('admin.packege_sale.index',compact('customers','package'));
    }

    //store
    public function store(Request $request)
    {
        // Extract array data from the request
        $serviceNames = $request->input('service_name', []);
        $serviceValues = $request->input('service_value', []);
        $quantities = $request->input('quantity', []);
    
        // Loop through each service entry and save it
        foreach ($serviceNames as $index => $serviceName) {
            $packegeSale = new PackegeSale(); // Create a new instance for each set of values
            $packegeSale->sale_date = $request->sale_date;
            $packegeSale->invoice_no = $request->invoice_no;
            $packegeSale->customer_id = $request->customer_id;
            $packegeSale->brand_name = $request->brand_name;
            $packegeSale->model = $request->model;
            $packegeSale->chasis_no = $request->chasis_no;
            $packegeSale->customer_mobile = $request->customer_mobile;
            $packegeSale->packege_id = $request->packege_id;
            $packegeSale->service_datetime = $request->service_datetime;
            $packegeSale->paid_amount = $request->paid_amount;
    
            // Set values for the current iteration
            $packegeSale->service_name = $serviceName;
            $packegeSale->service_value = $serviceValues[$index];
            $packegeSale->quantity = $quantities[$index];
            
            $packegeSale->save();
        }
    
        return back();
    }
    
    /**History area start**/
    public function PackageHistoryView(){
      $allData = PackegeSale::with('package')->get();

      return view('admin.packege_sale.history_view',compact('allData'));
    }

    public function PackageHistoryDetails($id){
      $detailsData = PackegeSale::with('package.services')->findOrFail($id);
      return view('admin.packege_sale.history_details', compact('detailsData'));
    }
  
    // Update quantity
    public function updateQuantity(Request $request, $id)
    {
        $detailsData = PackegeSale::findOrFail($id);

        if ($detailsData->quantity > 0) {
            $detailsData->quantity -= 1;
            $selectedDateTime = $request->input('selectedDateTime', null);
            $serviceDateTime = $selectedDateTime ? Carbon::parse($selectedDateTime) : null;
            $detailsData->service_datetime = $serviceDateTime;
            $detailsData->save();

            return response()->json(['success' => true, 'newQuantity' => $detailsData->quantity]);
        } else {
            return response()->json(['success' => false, 'message' => 'Quantity cannot go below 0.']);
        }
    }


    public function packageList()
    {
        $sales = PackegeSale::all();
        return view('admin.packege_sale.sale_list', compact('sales'));
    }


    public function sale_details($id)
    {
        $order = PackegeSale::findOrFail($id);
        return view('admin.packege_sale.sale_details', compact('order'));
    }

    public function sale_details_print($id)
    {
        $order = PackegeSale::where('id', $id)->first();
        return view('admin.packege_sale.sales_pdf', compact('order'));
    }


}
