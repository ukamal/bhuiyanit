<?php

namespace App\Http\Controllers\admin;

use App\Models\Sale;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PurchaseController extends Controller
{
    //purchaseAdd
    public function purchaseAdd()
    {
        $products = Product::all();
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();

        return view('admin.purchase.index',compact('products', 'customers', 'suppliers','brands'));
    }



public function purchaseStore(Request $request)
{
    //return response()->json($request->all());

    // Validate the request data
    $request->validate([
        'purchase_date' => 'required|date',
        'supplier_id' => 'required',
        'supplier_mobile' => 'required',
    ]);

    try {
        // Start a database transaction
        DB::beginTransaction();

        // Create a new Purchase instance and save it
        $purchase = Purchase::create([
            'purchase_date' => $request->input('purchase_date'),
            'purchase_no' => $request->input('purchase_no'),
            'supplier_id' => $request->input('supplier_id'),
            'brand_name' => $request->input('brand_name'),
            'model' => $request->input('model'),
            'supplier_mobile' => $request->input('supplier_mobile'),
            'grandTotal' => $request->input('grandTotal')[0], 
            'paid_amount' => $request->input('paid_amount')[0],
            'due_amount' => $request->input('due_amount')[0],
        ]);

        // Process purchase details
        $details = [];

        $prosize_ids = $request->input('prosize_id');
        $color_ids = $request->input('color_id');
        $qtys = $request->input('qty');
        $rates = $request->input('rate');
        $amounts = $request->input('amount');
        $grandTotal = $request->input('grandTotal')[0];

        foreach ($prosize_ids as $key => $prosize_id) {
            $details[] = [
                'purchase_id' => $purchase->id,
                'prosize_id' => $prosize_id,
                'color_id' => $color_ids[$key],
                'qty' => $qtys[$key],
                'rate' => $rates[$key],
                'amount' => $amounts[$key],
            ];
        }

        PurchaseDetail::insert($details);

        // Commit the transaction
        DB::commit();

        return redirect()->route('purchase_sale_list')->with('success', 'Purchase created successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating the purchase. Please try again.');
    }
}



    public function purchaseList(){
        $purchases = Purchase::orderBy('id','desc')->get();
        return view('admin.purchase.purchase_list',compact('purchases'));
    }

    public function purchaseDetails($id){
        $order = Purchase::with('purchaseDetails.product')->find($id);
        $details = PurchaseDetail::with('product')->where('purchase_id', $id)->get();

        // return response()->json($details);

        return view('admin.purchase.purchase_details', compact('order', 'details'));
    }
    
    

    public function purchasePdf($id){
        $order = Purchase::with('purchaseDetails')->find($id);
        $details = PurchaseDetail::where('purchase_id', $id)->get();
        return view('admin.purchase.purchase_pdf', compact('order','details'));
    }
    
    public function getSupplierMobile($supplierId)
    {
        $supplier = Supplier::find($supplierId);

        if ($supplier) {
            return response()->json(['phone' => $supplier->phone]);
        } else {
            return response()->json(['error' => 'Supplier not found'], 404);
        }
    }

    public function getSizes($productId)
    {
        $pro = Product::find($productId);

        if ($pro) {
            return response()->json(['size' => $pro->size]);
        } else {
            return response()->json(['error' => 'pro not found'], 404);
        }
    }

    public function getRate($colorId){
        $color = Product::find($colorId);
        if($color){
            return response()->json(['rate' => $color->rate]);
        }else{
            return response()->json(['error' => 'rate not found'], 404);
        }
    }


    public function removePurchase($id){
       $product = Purchase::findOrFail($id);
       Purchase::findOrFail($id)->delete();
    
       $details = PurchaseDetail::where('purchase_id',$product)->get();
       foreach($details as $item){
           PurchaseDetail::where('purchase_id',$id)->delete();
       }
    
       $notification = array(
           'message' => 'Purchase Deleted Successfully',
           'alert-type' => 'success'
       );
    
       return redirect()->back()->with($notification);
    }



}
