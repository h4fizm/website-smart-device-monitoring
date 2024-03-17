<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Device;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    public function index()
    {
        $sites = Site::all(); // Fetch all data from the 'sites' table
        $devices = Device::select('id_device', 'device_name', 'updated_at', 'status', 'id_sites')
            ->get(); // Fetch specific columns from the 'devices' table

        // Pass the data to the view
        return view('menu.report', compact('sites', 'devices'));
    }
    public function getDeviceBySiteId($site_id) {
        // $sites = Site::where('id_sites', $site_id)->get();
        $devices = Device::where('id_sites', $site_id)->get();
        return response()->json($devices); 
    }
}
