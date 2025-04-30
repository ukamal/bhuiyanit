<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function view(){
        $allData = Brand::orderBy('id','desc')->get();
        return view('admin.brand.view_brand',compact('allData'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'brand_name'  => 'required',
        ]);

        $inputData = new Brand();
        $inputData->brand_name    = $request->brand_name;
        $inputData->save();

        $notification = array(
            'message' => 'Brand added successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $id){
        $updateData = Brand::findOrFail($id);
        $updateData->brand_name    = $request->brand_name;
        $updateData->update();

        $notification = array(
            'message' => 'Brand update successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function delete($id){
        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand remove successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
