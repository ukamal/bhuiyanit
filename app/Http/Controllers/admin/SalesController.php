<?php

namespace App\Http\Controllers\admin;

use App\Models\Sale;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\SaleDetail;
use App\Models\PackegeSale;
use App\Models\SaleProduct;
use App\Models\GlassProduct;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\SaleTransaction;
use App\Models\GlassSaleProduct;
use Illuminate\Support\Facades\DB;
use App\Models\SupplierTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $customers = Customer::all();
        $brands = Brand::all();
        return view('admin.sales.index', compact('products', 'customers','brands'));
    }

    //start qty less update code

    public function store(Request $request)
    {
        //return response()->json($request->all());

        $validateData = $request->validate([
            'sale_date' => 'required',
        ]);
       
        try {
            DB::beginTransaction();

            $sale = Sale::create([
                'sale_date' => $request->input('sale_date'),
                'sale_no' => $request->input('sale_no'),
                'customer_id' => $request->input('customer_id'),
                'brand_name' => $request->input('brand_name'),
                'model' => $request->input('model'),
                'customer_address' => $request->input('customer_address'),
                'customer_mobile' => $request->input('customer_mobile'),
                'grandTotal' => $request->input('grandTotal')[0], 
                'paid_amount' => $request->input('paid_amount')[0],
                'due_amount' => $request->input('due_amount')[0],
            ]);

          

            // Create the invoice record associated with the sale
            $invoice = Invoice::create([
                'customer_id' => $sale->customer_id,
                'sale_id' => $sale->id,
                'invoice_date' => $request->input('sale_date'),
                'invoice_no' => $request->input('sale_no'),
                'type' => 'payment',
                'grandTotal' => $request->input('grandTotal')[0], 
            ]);
           
            $details = [];

            foreach ($request->input('prosize_id') as $key => $prosize_id) {
                $details[] = [
                    'sale_id' => $sale->id,
                    'prosize_id' => $prosize_id,
                    'color_id' => $request->input('color_id')[$key],
                    'qty' => $request->input('qty')[$key],
                    'rate' => $request->input('rate')[$key],
                    'amount' => $request->input('amount')[$key],
                ];
            }


            SaleDetail::insert($details);

            $this->updatePurchaseDetails($request->input('prosize_id'), $request->input('qty'));

            DB::commit();

            return redirect()->back()->with('success', 'Sale record created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating sale record. Please try again.');
        }
    }


    protected function updatePurchaseDetails($productIds, $quantities)
    {
        foreach ($productIds as $key => $productId) {
            $purchaseDetail = PurchaseDetail::where('prosize_id', $productId)->first();

            if ($purchaseDetail) {
                // Decrease the quantity in the PurchaseDetail
                $purchaseDetail->qty -= $quantities[$key];

                // Ensure that the quantity doesn't go below zero
                $purchaseDetail->qty = max(0, $purchaseDetail->qty);

                $purchaseDetail->save();
            }
        }
    }

    
   //end qty less update code



    public function receive_payment()
    {
        $sales_transacion = SaleTransaction::all();
        $customers = Customer::all();
        return view('admin.sales.receive_payment', compact('customers', 'sales_transacion'));
    }

    public function receive_report() {
        $selectedCus = $selectedSup = 0;
        $search = '';
        $invoices = Invoice::where('customer_id','!=', null);

        if (isset($_GET['customer']) && $_GET['customer'] != 0) {
            $selectedCus = $_GET['customer'];
            $invoices    = $invoices->where('customer_id', $selectedCus);
        }

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $search   = $_GET['search'];
            $invoices = $invoices->where('invoice_no', 'like', '%' . $search . '%')->orWhere('type', 'like', '%' . $search . '%');
        }
        
        $invoices = $invoices->get();
        $customer = Customer::get();
        return view('admin.report.receive_report',compact('invoices', 'customer', 'selectedCus', 'search', 'selectedSup'));
    }

    public function payment_report() {
        $selectedCus = $selectedSup = 0;
        $search = '';
        $invoices=Invoice::where('supplier_id','!=',null);
        if (isset($_GET['supplier']) && $_GET['supplier'] != 0) {
            $selectedSup = $_GET['supplier'];
            $invoices    = $invoices->where('supplier_id', $selectedSup);
        }

        if(isset($_GET['search']) && $_GET['search'] !== '') {
            $search = $_GET['search'];
            $invoices = $invoices->where('invoice_no', 'like', '%'.$search.'%')->orWhere('type', 'like', '%'.$search.'%');
        }

        $invoices = $invoices->get();
        $supplier = Supplier::get();
        return view('admin.report.payment_report',compact('invoices', 'supplier', 'selectedCus', 'selectedSup', 'search'));
    }

    public function receive_payment_store(Request $request)
    {
        $transaction = SaleTransaction::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $request->customer_id,
            'due' => $request->due,
            'date' => $request->date,
            'receive_amount' => $request->receive_amount,
            'description' => $request->description,
        ]);

        if ($transaction) {
            Invoice::create([
                'customer_id' => $request->customer_id,
                'invoice_date' => $request->date,
                'transaction_id' => $transaction->id,
                'invoice_no' => invoice_no(),
                'type' => 'receive',
                'grandTotal' => $request->receive_amount,
            ]);
        }


        return redirect()->back();
    }

    public function supplier_payment_store(Request $request)
    {
        $transaction=SupplierTransaction::create([
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier_id,
            'due' => $request->due,
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        if ($transaction) {
            Invoice::create([
                'supplier_id' => $request->supplier_id,
                'invoice_date' => $request->date,
                'transaction_id' => $transaction->id,
                'invoice_no' => invoice_no(),
                'type' => 'payment',
                'grandTotal' => $request->amount,
            ]);
        }
        return redirect()->back();
    }

    public function customer_due($customer_id)
    {
        $cutomer = Order::where('customer_id', $customer_id)->get();
        $grandTotal = $cutomer->sum('grandTotal');
        $cutomer_comission = $cutomer->sum('customer_comm');
        $customer_advence = $cutomer->sum('customer_advence');

        $receive_amount = $grandTotal - $cutomer_comission;

        $sale_transaction = SaleTransaction::where('customer_id', $customer_id)->sum('receive_amount');
        $due = $receive_amount - ($customer_advence + $sale_transaction);
        return response()->json($due);
    }

    public function supplier_due($supplier_id)
    {
        $supplier = Order::where('supplier_id', $supplier_id)->get();
        $grandTotal = $supplier->sum('grandTotal');

        $supplier_comm = $supplier->sum('supplier_comm');
        $supplier_advenced = $supplier->sum('supplier_advenced');

        $supplier_transaction = SupplierTransaction::where('supplier_id', $supplier_id)->sum('amount');
        $payment_amount = $grandTotal - $supplier_comm;
        $due = $payment_amount - ($supplier_advenced + $supplier_transaction);
        return response()->json($due);
    }

    public function supplier_payment()
    {
        $SupplierTransaction = SupplierTransaction::orderBy('id','desc')->get();
        $suppliers = Supplier::all();
        return view('admin.order.supplier_payment', compact('suppliers', 'SupplierTransaction'));
    }

    public function payment_report_additiona_comm(Request $request)
    {
        $invoice = Invoice::find($request->product);
        if ($invoice) {
            // $order
        }
    }

    /************** Package Sale List ***********/
    public function list()
    {
        $sales = Sale::orderBy('id','desc')->get();
        return view('admin.sales.sale_list', compact('sales'));
    }

    public function onlySaleDetails($id)
    {
        $products = SaleDetail::where('sale_id',$id)->get();
        // return response()->json($products);
        $order = Sale::where('id', $id)->first();
        return view('admin.sales.sale_details', compact('order','products'));
    }

    public function saleReturn($id){
        $products = SaleDetail::where('sale_id',$id)->get();
        // return response()->json($products);
        $order = Sale::where('id', $id)->first();
        return view('admin.sales.sale_return', compact('order','products'));
    }

    public function salePdf($id){
        $order = Sale::where('id', $id)->first();
        return view('admin.sales.sales_pdf', compact('order'));
    }

    /********Receive Payment Print**************/
    public function receive_payment_print($id){
        $customers = Customer::find($id);
        $sales_transacion = SaleTransaction::find($id);
        return view('admin.payment.paymentPdf', compact('customers','sales_transacion'));
    }

    /********Receive Report Print**************/
    public function receive_report_print($id){
        $customers = Customer::find($id);
        $recive_payment = Invoice::with('receivPayment')->find($id);
        return view('admin.payment.report_pdf', compact('customers','recive_payment'));
    }

    /********Supplier payment Print**************/
    public function supplier_payment_print($id){
        $supplier = Supplier::find($id);
        $sales_transacion = SupplierTransaction::find($id);
        return view('admin.payment.supplier_payment_pdf', compact('supplier','sales_transacion'));
    }
    
    /********Supplier report Print**************/
    public function supplier_payment_report_pdf($id){
        $supplier = Supplier::find($id);
        $sales_transacion = SupplierTransaction::find($id);
        return view('admin.payment.supplier_payment_report_pdf', compact('supplier','sales_transacion'));
    }

    public function saleDelete($id){
        // Delete sale details first
        SaleDetail::where('sale_id', $id)->delete();
    
        // Then delete the sale
        $sale = Sale::find($id);
        if ($sale) {
            $sale->delete();
        }
    
        return redirect()->back();
    }
    

    
}
