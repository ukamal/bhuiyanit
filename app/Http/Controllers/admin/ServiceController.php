<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Toastr;

class ServiceController extends Controller
{
    //addNewService
    public function addNewService()
    {
        $service = Service::all();
        return view('admin.service.index',compact('service'));
    }
    //storeService

    public function storeService(Request $request)
    {
        $request->validate([
            'service_name'=>'required',
            'service_value'=>'required',
            'service_dsc'=>'required',
            'quantity'=>'required'
            
        ]);
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->service_value = $request->service_value;
        $service->quantity = $request->quantity;
        $service->service_dsc = $request->service_dsc;
        $service->save();


        $notification = array(
            'message' => 'Service added successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    //editService
    public function editService($id){
        $service = Service::find($id);
        return view('admin.service.edit-service',compact('service'));
    }
    //updateService
    public function updateService(Request $request,$id){
        {
            $service = Service::find($id);
            $request->validate([
                'service_name'=>'required',
                'service_value'=>'required',
                'service_dsc'=>'required'
            ]);
            $service->service_name = $request->service_name;
            $service->quantity = $request->quantity;
            $service->service_value = $request->service_value;
            $service->service_dsc = $request->service_dsc;
            $service->save();
            if($service){
                Toastr::success('Successfully Updated', 'Title', ["positionClass" => "toast-top-right"]);
            }
            return back();
        }
    }
    //deleteService
    public function deleteService($id){
        $service = Service::find($id);
        $service->delete();
        return back();
    }
}
