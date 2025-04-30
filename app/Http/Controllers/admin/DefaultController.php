<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Service;

class DefaultController extends Controller
{
    public function getPackege(Request $request)
    {
        $package_id = $request->packege_id;
        $package = Package::find($package_id);
    
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }
    
        $services = Service::join('package_service', 'services.id', '=', 'package_service.service_id')
            ->where('package_service.package_id', $package_id)
            ->select('services.id', 'services.service_name', 'services.service_value', 'services.quantity')
            ->get();
    
        return response()->json($services);
    }
    

}
