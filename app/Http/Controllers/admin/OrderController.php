<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\GlassProduct;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderGlassProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    /**
     * @param Request $request
     */
    public function index(Request $request) {

        $products  = null;
        $customers = Customer::all();
        $suppliers = Supplier::all();
        if ($request->type == "Aluminium") {
            $products = Product::where('product_type', "Aluminium")->get();
        } elseif ($request->type == "Glass") {
            $products = GlassProduct::get();
            return view('admin.order.glassOrder', compact('products', 'customers', 'suppliers'));
        } else {
            $products = Product::where('product_type', "SS")->get();
        }

        return view('admin.order.index', compact('products', 'customers', 'suppliers'));
    }

    /**
     * @param Request $request
     */
    
    public function store(Request $request) {

        // return Auth::id();
        // return $request->all();
        // dd($request->all());

        if($request->order_type == 'Glass'){
            $data = [
                'other_text'           => ($request->other_text)??'',
                'order_no'             => $request->order_no,
                'order_type'           => $request->order_type,
                'user_id'              => (Auth::id())??0,
                'order_date'           => $request->order_date,
                'customer_id'          => $request->customer,
                'supplier_id'          => $request->supplier,
                'customer_address'     => $request->customer_address,
                'supplier_address'     => $request->supplier_address,
                'customer_mobile'      => $request->customer_mobile,
                'supplier_mobile'      => $request->supplier_mobile,
                'supplier_comm'        => $request->supplier_comm_show,
                'supplier_com_percent' => $request->supplier_com_percent,
                'supplier_advenced'    => $request->supplier_advenced,
                'customer_comm'        => $request->customer_comm_show,
                'customer_com_percent' => $request->customer_com_percent,
                'customer_advence'     => $request->customer_advence,
                'grandTotal'           => $request->grandTotal,
                'carrying_charge'      => ($request->carrying_cost)??0,
            ];
            $order = Order::create($data);
            if ($order) {
                Invoice::create([
                    'customer_id'          => $request->customer,
                    'supplier_id'          => $request->supplier,
                    'order_id'             => $order->id,
                    'invoice_date'         => $order->order_date,
                    'invoice_no'           => invoice_no(),
                    'type'                 => 'order',
                    'supplier_comm'        => $request->supplier_comm_show,
                    'supplier_com_percent' => $request->supplier_com_percent,
                    'supplier_advenced'    => $request->supplier_advenced,
                    'customer_comm'        => $request->customer_comm_show,
                    'customer_com_percent' => $request->customer_com_percent,
                    'customer_advence'     => $request->customer_advence,
                    'grandTotal'           => $request->grandTotal,
                    'carrying_charge'      => ($request->carrying_cost)??0,
                ]);
    
                if($request->glass_product_id && count($request->glass_product_id) > 0) {
                    $productLength = count($request->glass_product_id);
                    for ($i = 0; $i < $productLength; $i++) {
                        OrderGlassProduct::create([
                            'order_id'    => $order->id,
                            'glass_product_id'  => $request->glass_product_id[$i],
                            'type_of_glass'  => $request->type_of_glass[$i],
                            'thickness'  => $request->thickness[$i],
                            'size_x'  => $request->size_x[$i],
                            'size_y'  => $request->size_y[$i],
                            'pcs'  => $request->pcs[$i],
                            'sft'  => $request->sft[$i],
                            'mt'  => $request->mt[$i],
                            'rate' => $request->rate[$i]
                        ]);
                    }
                }
     
            }
        }else{
            // For Aluminium & SS
            $data = [
                'other_text'           => ($request->other_text)??'',
                'order_no'             => $request->order_no,
                'order_type'           => $request->order_type,
                'user_id'              => (Auth::id())??0,
                'order_date'           => $request->order_date,
                'customer_id'          => $request->customer,
                'supplier_id'          => $request->supplier,
                'company_profile'      => $request->company_profile,
                'customer_address'     => $request->customer_address,
                'supplier_address'     => $request->supplier_address,
                'customer_mobile'      => $request->customer_mobile,
                'supplier_mobile'      => $request->supplier_mobile,
                'supplier_comm'        => $request->supplier_comm_show,
                'supplier_com_percent' => $request->supplier_com_percent,
                'supplier_advenced'    => $request->supplier_advenced,
                'customer_comm'        => $request->customer_comm_show,
                // 'customer_com_percent' => $request->customer_com_percent,
                // 'customer_advence'     => $request->customer_advence,
                'grandTotal'           => $request->grandTotal,
                'carrying_charge'      => ($request->carrying_cost)??0,
            ];
            $order = Order::create($data);
            if ($order) {
                Invoice::create([
                    'customer_id'          => $request->customer,
                    'supplier_id'          => $request->supplier,
                    'order_id'             => $order->id,
                    'invoice_date'         => $order->order_date,
                    'invoice_no'           => invoice_no(),
                    'type'                 => 'order',
                    'supplier_comm'        => $request->supplier_comm_show,
                    'supplier_com_percent' => $request->supplier_com_percent,
                    'supplier_advenced'    => $request->supplier_advenced,
                    'customer_comm'        => $request->customer_comm_show,
                    'customer_com_percent' => $request->customer_com_percent,
                    'customer_advence'     => $request->customer_advence,
                    'grandTotal'           => $request->grandTotal,
                    'carrying_charge'      => ($request->carrying_cost)??0,
                ]);
    
                if($request->product_id && count($request->product_id) > 0) {
                    $productLength = count($request->product_id);
                    for ($i = 0; $i < $productLength; $i++) {
                        OrderProduct::create([
                            'order_id'    => $order->id,
                            'product_id'  => $request->product_id[$i],
                            'color'  => $request->order_type == 'SS' ? 'ss' : $request->color[$i],
                            'rate'  => $request->rate[$i],
                            'qty'   => $request->qty[$i],
                        ]);
                    }
                }
     
            }
        }




        // // if Glass Product Previous Code
        // foreach ($request->ammount as $key => $value) {
        //     $size = (($request->size_x[$key])??'').' * '.(($request->size_y[$key])??'').' = '.(($request->sft[$key])??'');
        //     $data = [
        //         'die'              => '',
        //         'supplier_id'      => 0,
        //         'item_description' => ($request->type_of_glass[$key])??'',
        //         'unit'             => 'sft',
        //         'size'             => $size,
        //         'product_type'     => 'Glass',
        //         'color'            => (($request->thikness[$key])??'').'#'.(($request->mt[$key])??''),
        //         'silver_rate'      => 0,
        //         'bronze_rate'      => 0,
        //         'ss_rate'          => 0,
        //         'other_rate'       => ($request->rate[$key])??0,
        //     ];
        //     $product = Product::create($data);
        //     if ($product) {
        //         OrderProduct::create([
        //             'order_id'    => $order->id,
        //             'product_id'  => $product->id,
        //             'silver_rate' => ($product->silver_rate)??0,
        //             'silver_qty'  => ($product->silver_qty)??0,
        //             'bronze_rate' => ($product->bronze_rate)??0,
        //             'bronze_qty'  => ($product->bronze_qty)??0,
        //             'ss_rate'     => ($product->ss_rate)??0,
        //             'ss_qty'      => ($product->ss_qty)??0,
        //             'other_rate'  => ($product->other_rate)??0,
        //             'other_qty'   => ($request->pcs[$key])??0,
        //         ]);
        //     }
        // }

        return redirect()->back();
    }

    
    public function order_list() {
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.order.order_list', compact('orders'));
    }

    public function customer_order_list() {
        $orders = Order::all();
        return view('admin.order.cutomer_order_list', compact('orders'));
    }

    public function supplier_order_list() {
        $orders = Order::all();
        return view('admin.order.suppler_order_list', compact('orders'));
    }

    /**
     * @param $order_id
     */
    public function order_details($order_id) {
        $order     = Order::with('products.product')->find($order_id);
        $products  = Product::all();
        $customers = Customer::all();
        $suppliers = Supplier::all();
        return view('admin.order.order_details', compact('order', 'products', 'customers', 'suppliers'));
    }

    /**
     * @param $order_id
     */
    public function order_pdf($order_id) {
        $order     = Order::find($order_id);
        $products  = Product::all();
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $data      = [
            'order' => $order,
        ];

        return view('admin.order.order_pdf', compact('order', 'products', 'customers', 'suppliers'));
    }

    public function order_challan_pdf($order_id) {
        $order     = Order::find($order_id);
        $products  = Product::all();
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $data      = [
            'order' => $order,
        ];

        return view('admin.order.order_challan_pdf', compact('order', 'products', 'customers', 'suppliers'));
    }

}
