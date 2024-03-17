<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Site;
use App\Models\Device;
use App\Models\Source;

class SitesController extends Controller
{
    public function index($site)
    {
        // dd($site);
        // Retrieve the site details including updated_at
        $siteDetails = Site::where('name', $site)->first();

        // Retrieve the latest device for the given site
        $latestDevice = Device::where('id_sites', $siteDetails->id)
            ->latest('updated_at')
            ->first();

        return view('menu.sites', compact('site', 'siteDetails', 'latestDevice'));
    }

    public function getSourceData($deviceId)
    {
        // Fetch source data from the database using the Device model
        $device = Device::where('id_device', $deviceId)->first();
        $sourceData = $device->getAllSourceData();

        // Return the source data as JSON response
        return response()->json($sourceData);
    }

    public function deviceDetail($site, $deviceId)
    {
        // dd($site); 
        try {
            $siteName = ucwords(str_replace('-', ' ', $site)); // Convert slug to site name
            $site = Site::where('name', $siteName)->first();
            $device = Device::where('id_device', $deviceId)->first();
            $source = $device->getSourceData();
            // dd($site); 
            return view('menu.device', compact('site', 'device', 'source'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the device is not found
            return response()->view('errors.device-not-found', ['deviceName' => $site], 404);
        }
    }

    // Fungsi menambah site
    public function listSite()
    {
        // Mendapatkan semua situs dari tabel 'sites'
        $sites = Site::all();

        // Untuk setiap situs, tambahkan informasi jumlah perangkat yang terhubung dengan situs tersebut
        foreach ($sites as $site) {
            $site->total_devices = Device::getTotalBySiteId($site->id_sites);
        }

        // Melewatkan data situs yang telah diperbaharui ke view
        return view('menu.reportSite', compact('sites'));
    }
    public function addSite()
    {
        return view('menu.addSite');
    }
    public function storeSite(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'site_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan data ke dalam tabel 'sites'
        Site::create([
            'name' => $request->site_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect kembali ke halaman sebelumnya atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Device added successfully!');
    }

    // Fungsi Edit Sites
    public function edit($siteId)
    {
        // Cari site berdasarkan ID
        $site = Site::findOrFail($siteId);

        // Tampilkan halaman edit dengan data site
        return view('menu.editSite', compact('site'));
    }

    public function update(Request $request, $siteId)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'site_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Perbarui data site
        Site::where('id_sites', $siteId)->update([
            'name' => $request->site_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('sites.edit', ['SiteId' => $siteId])->with('success', 'Site updated successfully!');

    }
    // delete site
    public function delete($siteId)
    {
        try {
            // Cari dan hapus situs berdasarkan ID
            Site::findOrFail($siteId)->delete();
            return redirect()->route('sites.list')->with('success', 'Site deleted successfully!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika situs tidak ditemukan atau tidak dapat dihapus
            return redirect()->route('sites.list')->with('error', 'Failed to delete site.');
        }
    }



    // Fungsi menambah device 
    public function listDevice()
    {
        // Ambil semua perangkat
        $devices = Device::with('site')->get(); // Menggunakan with('site') untuk mengambil relasi site

        // Melewatkan data perangkat ke view
        return view('menu.reportDevice', compact('devices'));
    }
    public function addDevice()
    {
        $sites = Site::pluck('name', 'id_sites')->toArray(); // Mengambil daftar situs untuk dropdown

        return view('menu.addDevice', compact('sites'));
    }

    public function storeDevice(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'site' => [
                'required',
                Rule::exists('sites', 'id_sites')->where(function ($query) {
                    $query->whereNotNull('name');
                }),
            ],
        ]);

        // Buat objek model baru untuk perangkat
        $device = new Device();
        $device->device_name = $request->input('fname');
        $device->id_sites = $request->input('site');

        // Simpan perangkat ke dalam database
        $device->save();

        // Tambahkan data ke dalam tabel 'sources'
        $source = new Source();
        $source->id_device = $device->id_device; // Assign the id_device property
        $source->voltage = 0;
        $source->current = 0;
        $source->power = 0;
        $source->temperature = 0;
        $source->operation_time = 0;
        $source->save();

        // Redirect kembali ke halaman sebelumnya atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Device added successfully!');
    }

    public function showDeviceList()
    {
        $sites = Site::all(); // Ambil semua data situs dari database
        return view('menu.reportDevice', ['sites' => $sites]);
    }
}
