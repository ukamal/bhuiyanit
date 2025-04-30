<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\SaleDetail;
use App\Models\SaleReturn;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleRetunrController extends Controller
{

    // public function saleRetrun(){
    //     $invoices = Invoice::with('customer')->orderBy('id','desc')->get();
    //     // return response()->json($invoices);
    //     return view('admin.return_product.view_return',compact('invoices'));
    // }
    
    public function customerProInfo($id){
        // Retrieve invoice information
        $invoice = Invoice::findOrFail($id);
    
        // Retrieve customer information
        $customer = Customer::findOrFail($invoice->customer_id);
    
        // Retrieve products related to this invoice
        $products = SaleDetail::where('sale_id', $invoice->sale_id)->get();
    
        return view('admin.return_product.customer_with_product_info', compact('customer', 'products'));
    }

    public function saleByCustomer($id,$invoice_no)
    {
        $sale = Sale::where([
                ['customer_id','=',$id],
                ['sale_no','=',$invoice_no],
            ])->first();

        $saleProduct = SaleDetail::where('sale_id', $sale->id)->get();

        $customer = Customer::find($id);
        return view('admin.return_product.list_table',compact('saleProduct','customer','sale'));
    }

   


//     public function salesReturnStore(Request $request) {
      
//         $previous_invoice = Invoice::where('invoice_no', $request->previous_invoice_no)->first();

//         if ($previous_invoice) {
//             foreach ($request->product_id as $index => $product_id) {
//                 $sale_return = SaleReturn::create([
//                     'return_date' => $request->sale_return_date,
//                     'customer_id' => $request->customer_id,
//                     'previous_invoice_id' => $previous_invoice->id, // Use the ID of the invoice
//                     'previous_invoice_no' => $request->previous_invoice_no,
//                     'category_id' => $request->category_id[$index],
//                     'product_id' => $product_id,
//                     'return_quantity' => $request->returned_quantity[$index],
//                     'return_rate' => $request->returned_rate[$index],
//                     'return_amount' => $request->returned_amouont_input[$index],
//                     'invoice_no' => $request->new_invoice_no,
//                     'sale_id' => $request->sale_id,
//                     'sales_price' => $request->sales_price,
//                     'note' => $request->note,
//                     'total' => $request->note,
//                 ]);
//             }
//         } else {
//             toastr()->error('Previous invoice not found', 'Error');
//             return redirect()->back();
//         }
        

//     $invoice = Invoice::create([
//         'customer_id' => $request->customer_id,
//         'sale_id' => $request->new_invoice_no,
//         'invoice_date' => $request->sale_return_date,
//         'type' => 'sale_return',
//         'grandTotal' => $request->total_amount_input,
//     ]);

//     if ($invoice) {
//         toastr()->success('Sale Return Success', 'Success');
//         return redirect()->back();
//     }
// }




public function salesReturnStore(Request $request) {
    $previous_invoice = Invoice::where('invoice_no', $request->previous_invoice_no)->first();

    if (!$previous_invoice) {
        toastr()->error('Previous invoice not found', 'Error');
        return redirect()->back();
    }

    // Loop through each product returned
    foreach ($request->product_id as $index => $product_id) {
        // Create a sale return record
        $sale_return = SaleReturn::create([
            'return_date' => $request->sale_return_date,
            'customer_id' => $request->customer_id,
            'previous_invoice_id' => $previous_invoice->id,
            'previous_invoice_no' => $request->previous_invoice_no,
            'category_id' => $request->category_id[$index],
            'product_id' => $product_id,
            'return_quantity' => $request->returned_quantity[$index],
            'return_rate' => $request->returned_rate[$index],
            'return_amount' => $request->returned_amouont_input[$index],
            'invoice_no' => $request->new_invoice_no,
            'sale_id' => $request->sale_id,
            'sales_price' => $request->sales_price,
            'note' => $request->note,
            'total' => $request->note,
        ]);

        // Update SaleDetail to deduct returned quantity
        $saleDetail = SaleDetail::where('sale_id', $request->sale_id)
                                ->where('prosize_id', $product_id)
                                ->first();

        if ($saleDetail) {
            $saleDetail->update([
                'qty' => $saleDetail->qty - $request->returned_quantity[$index]
            ]);
        } else {
            toastr()->error('Sale Detail not found for product ID: ' . $product_id, 'Error');
            return redirect()->back();
        }
    }

    // Create a new invoice for the return
    $invoice = Invoice::create([
        'customer_id' => $request->customer_id,
        'sale_id' => $request->new_invoice_no,
        'invoice_date' => $request->sale_return_date,
        'type' => 'sale_return',
        'grandTotal' => $request->total_amount_input,
    ]);

    if ($invoice) {
        toastr()->success('Sale Return Success', 'Success');
        return redirect()->back();
    }
}






    public function saleRetrun(){
        $customers= Customer::all();
        $products= Product::all();
        // $employees= Employee::all();
        $sales = Sale::all();
        $invoice = Invoice::orderBy('id','DESC')->first();
        $uid=0;
        $newInvoice=0;
        if($invoice== null){
            $uid= 220000000 ;
        }else{
            $newInvoice =$invoice->invoice_no + 1;
        }
        return view('admin.return_product.view_return',compact('products','customers','sales','newInvoice'));
    }

    public function getCustomerSaleInvoice($id)
    {
        $customer_sale = Sale::where('customer_id',$id)->get();
        return response()->json($customer_sale);
    }

    public function salesEntryStore(Request $request)
    {
        $list = json_decode($request->sale_order);
//        return response()->json($list);
//        $order = Order::where('id', $order_id)->first();
//        // dd($list,$order);
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'invoice_no' => $request->invoice_no,
            // 'sale_type' => $request->sale_type,
            'employee_id' => $request->employee_id ,
            'total_amount' => $request->total,
            'sub_total' => $request->subtotal,
            'total_vat' => $request->percentage,
            'total_vat_amount' => $request->calculate_amount_vat,
            'total_discount' => $request->discount,
            'total_transport' => $request->transport,
            'total_paid' => $request->paid,
            'total_due' => $request->due,
            'sale_date' => $request->sale_date,

//            'customer_name' => $request->sale_date,
            'customer_contact' => $request->supplier_contact,
            'customer_address' => $request->supplier_address,
            'note' => $request->note,
//            'barcode' => '',
            'user_id' => auth()->user()->id,
            'branch_id' => auth()->user()->branch_id
        ]);
        $sale_id = $sale->id;
        if (count($list) > 0) {
            // dd($list[0]->booking_supplier);
            for ($i = 0; $i < count($list); $i++) {
//                $suppler = Supplier::where('name', 'Like', '%' . $list[$i]->booking_supplier . '%')->first();
                // dd($suppler);
                SaleProduct::create([

                    'sale_date' => $request->sale_date,
                    'product_id' => $list[$i]->product_id,
//                    'supplier_id' => $request->supplier_id,
                    'customer_id' => $request->customer_id,
                    'sale_id' => $sale_id,
//                    'warehouse_id' => '',
//                    'product_unit_id' => '',
                    'product_name' => $list[$i]->product_name,
                    'category_id' => $list[$i]->category,
                    'invoice_no' => $request->invoice_no,
                    'quantity' => $list[$i]->quantity,
                    'total' => $list[$i]->total,
                    'barcode' => '',
                    'purchase_price' => $list[$i]->purchase_rate,
                    'sale_price' => $list[$i]->sells_rate,
                    'size' => '',
                    'capacity' => '',
                    'manufacture_date' => '',
                    'expiry_date' => '',
                    'branch_id' => auth()->user()->branch_id,

                ]);
            }
        }

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'employee_id' => $request->employee_id ,
            'invoice_no' => $request->invoice_no,
            'invoice_date' => $request->sale_date,
            'type' => 'sale',
            'status' => 'active',
            'total_amount' => $request->total,
            'total_vat' => $request->percentage,
            'total_vat_amount' => $request->calculate_amount_vat,
            'total_discount' => $request->discount,
            'total_transport_cost' => $request->transport,
            'total_paid' => $request->paid,
            'total_due' => $request->due,
            'branch_id' => auth()->user()->branch_id,
            'user_id' => auth()->user()->id,
            'note' => $request->note,
        ]);
        
        if ($invoice) {
            toastr()->success('Purchase Success', 'Success');
            return response()->json($sale_id);
        }
    }
    

}
