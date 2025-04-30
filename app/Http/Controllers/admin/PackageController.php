<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //addNewPackage
    public function addNewPackage(){
        $service = Service::all();
        $package = Package::all();
        return view('admin.package.package',compact('service','package'));
    }


    public function storePackege(Request $request)
    {
        $request->validate([
            'packege_name' => 'required',
            'service_id' => 'required|array',
            'packege_value' => 'required',
            'currency' => 'required',
            'packege_dsc' => 'required'
        ]);

        $package = new Package();
        $package->packege_name = $request->packege_name;
        $package->packege_value = $request->packege_value;
        $package->currency = $request->currency;
        $package->packege_share = $request->packege_share;
        $package->packege_dsc = $request->packege_dsc;
        $package->save();

        // Attach selected services to the package
        $package->services()->attach($request->service_id);

        return back();
    }


    //updatePackege
    public function updatePackege(Request $request,$id){
        $package = Package::find($id);
        $request->validate([
            'packege_name'=>'required',
            'service_id'=>'required',
            'packege_value'=>'required',
            'currency'=>'required',
            'packege_share'=>'required',
            'packege_dsc'=>'required'
        ]);
        $package->packege_name = $request->packege_name;
        $package->service_id = $request->service_id;
        $package->packege_value = $request->packege_value;
        $package->currency = $request->currency;
        $package->packege_share = $request->packege_share;
        $package->packege_dsc = $request->packege_dsc;
        $package->save();
        return back();
    }
    //deletePackege
    public function deletePackege($id){
        $package = Package::find($id);
        $package->delete();
        return back();
    }
}
