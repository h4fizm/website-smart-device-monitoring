<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Site;

class DeviceController extends Controller
{
    public function index()
    {
        // Fetch all devices with their related sites
        $devices = Device::with('site')->get();
        $sites = Site::all(); // Ambil semua situs

        // Pass devices and sites to the view
        return view('menu.reportDevice', compact('devices', 'sites'));
    }


    public function edit($deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $sites = Site::pluck('name', 'id_sites'); // Ambil daftar nama situs
        return view('menu.editDevice', compact('device', 'sites'));
    }

    public function update(Request $request, $deviceId)
    {
        $device = Device::findOrFail($deviceId);

        // Update name
        $device->device_name = $request->input('device_name');

        // Check if site is selected
        if ($request->has('site') && $request->input('site') != null) {
            // Update site
            $device->id_sites = $request->input('site');

            $device->save();

            return redirect()->route('devices.edit', $device->id_device)->with('success', 'Device updated successfully');
        } else {
            return redirect()->route('devices.edit', $device->id_device)->with('warning', 'Sites must be selected');
        }
    }

    public function delete($id)
    {
        try {
            $device = Device::findOrFail($id);
            $device->delete();

            return redirect()->route('menu.reportDevice')->with('success', 'Device deleted successfully');
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            dd($e->getMessage()); // For debugging purposes
        }
    }
}
