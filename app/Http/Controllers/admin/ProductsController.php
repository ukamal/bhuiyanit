<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\GlassProduct;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;

class ProductsController extends Controller {


    public function index() {
        $search = $search_brand = '';
    
        $products = Product::orderBy('id', 'desc');
    
        if (isset($_GET['brand_id']) && $_GET['brand_id'] !== '') {
            $search_brand = $_GET['brand_id'];
            $products->where('brand_id', $search_brand);
        }
    
        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $search = $_GET['search'];
            $products->where(function ($query) use ($search) {
                $query->where('item_description', 'like', '%'.$search.'%')
                    ->orWhere('die', 'like', '%'.$search.'%');
            });
        }
    
        $products = $products->get();
        // return response()->json($products);

        $brand = Brand::all();
        $category = Category::all();
    
        return view('admin.product.index', compact('category', 'products', 'brand', 'search', 'search_brand'));
    }
    
    




    public function getProduct($product_id) {
        $product = Product::where('id', $product_id)->first();
        return response()->json($product);
    }

    public function store(Request $request) {
        //dd($request->all());

            $data = [
                'brand_id'         => $request->brand_id,
                'product_category' => $request->product_category,
                'product_name' => $request->product_name,
                'unit'             => $request->unit,
                'code'             => $request->code,
                'color'            => $request->color,
                'rate'             => $request->rate,
            ];
            $product = Product::create($data);
        
            $notification = array(
                'message' => 'product added success',
                'alert-type' => 'success',
            );
        return redirect()->back()->with($notification);
    }


    public function update(Request $request, $id) {

            $data = [
                'brand_id'         => $request->brand_id,
                'product_category' => $request->product_category,
                'product_name' => $request->product_name,
                'unit'             => $request->unit,
                'code'             => $request->code,
                'color'            => $request->color,
                'rate'             => $request->rate,
            ];
            $product = Product::find($id)->update($data);
        
        
        return redirect()->back();
    }


    public function destroy($id) {
        // First, delete or update related records in 'purchase_details' table
        PurchaseDetail::where('prosize_id', $id)->delete();
        PurchaseDetail::where('color_id', $id)->delete();
    
        // Now, delete the record from 'products' table
        Product::find($id)->delete();
    
        return redirect()->back();
    }

    
}
