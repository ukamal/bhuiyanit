<?php

use App\Models\Sale;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\Qoutation;

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
function sale_no(){
    $order = Sale::orderBy('id','DESC')->first();
    if($order){
        $order_no=$order->sale_no+1;
        return $order_no;
    }else{
        $order_no=10001;
        return $order_no;
    }

}
function qoutation_no(){
    $order = Qoutation::orderBy('id','DESC')->first();
    if($order){
        $order_no=$order->qoutation_no+1;
        return $order_no;
    }else{
        $order_no=10001;
        return $order_no;
    }
}
function invoice_no(){
    $order = Invoice::orderBy('id','DESC')->first();
    if($order){
        $order_no=$order->invoice_no+1;
        return $order_no;
    }else{
        $order_no=10001;
        return $order_no;
    }
}

// function purchase_no(){
//     $purchase = Purchase::orderBy('id','desc')->first();
//     if($purchase){
//         $purchase_no = $purchase->invoice_no+1;
//         return $purchase_no;
//     }else{
//         $purchase_no = 10001;
//         return $purchase_no;
//     }
// }

function generate_purchase_no() {
    $last_purchase = Purchase::orderBy('id', 'desc')->first();

    if ($last_purchase) {
        $last_purchase_no = intval(substr($last_purchase->invoice_no, 4)); // Extracting numeric part after "PUR-"
        $new_purchase_no = $last_purchase_no + 1;
    } else {
        // Start with a default value if no purchases exist
        $new_purchase_no = 1;
    }

    // You can adjust the prefix according to your requirement
    $prefix = 'PO-';
    $purchase_no = $prefix . str_pad($new_purchase_no, 5, '0', STR_PAD_LEFT); // Ensuring 5 digits with padding

    return $purchase_no;
}


// function invoiceNo(){
//     $invoice = Invoice::orderBy('id','DESC')->first();
//     $uid=0;
//     $newInvoice=0;
//     if($invoice==null){
//         $newInvoice= 1000;
//     }else{
//         $newInvoice =$invoice->invoice_no + 1;
//     }
//     return $newInvoice;
// }

function invoiceNo(){
    $invoice = Invoice::orderBy('id','DESC')->first();
    $newInvoice = 0;
    
    if($invoice == null){
        $newInvoice = 1;
    } else {
        $newInvoice = $invoice->invoice_no + 1;
    }
    
    // Format the invoice number to have leading zeros and be 4 digits long
    $formattedInvoice = str_pad($newInvoice, 4, '0', STR_PAD_LEFT);
    
    return $formattedInvoice;
}


// for project down

if (!function_exists('isProjectDownAfterOneDay')) {
    /**
     * Check if the project is down after 1 day from today.
     *
     * @return bool
     */
    function isProjectDownAfterOneDay()
    {
        $currentDate = time();
        $endDate = strtotime('tomorrow'); // Gets the timestamp for the start of the next day

        return $currentDate < $endDate;
    }
}
