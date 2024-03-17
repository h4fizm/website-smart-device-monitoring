<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Site;
use App\Models\Source;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $primaryKey = 'id_device'; // Mengubah primary key yang benar

    protected $fillable = ['device_name', 'id_sites', 'updated_at']; // Mengubah fillable untuk sesuai kolom yang benar

    public function site()
    {
        return $this->belongsTo(Site::class, 'id_sites'); // Mengubah foreign key yang benar
    }

    public function getSourceData()
    {
        return $this->hasMany(Source::class, 'id_device', 'id') // Mengubah relasi dengan model Source
            ->orderByDesc('created_at') // Menggunakan metode Eloquent untuk pengurutan
            ->first();
    }

    public function getAllSourceData()
    {
        return $this->hasMany(Source::class, 'id_device', 'id')->get(); // Mengubah relasi dengan model Source
    }

    public static function getBySiteId($siteId)
    {
        return self::where('id_sites', $siteId)->get(); // Mengubah kueri untuk mencari berdasarkan id_sites
    }

    public function getSiteLocation()
    {
        return $this->site ? $this->site->name : 'No Location Assigned';
    }

    public static function getTotalBySiteId($siteId)
    {
        return self::where('id_sites', $siteId)->count(); // Mengubah kueri untuk mencari berdasarkan id_sites
    }

    public static function getLastUpdateBySiteId($siteId)
    {
        return self::where('id_sites', $siteId)
            ->latest('updated_at')
            ->first(); // Mengubah kueri untuk mencari berdasarkan id_sites
    }
}
