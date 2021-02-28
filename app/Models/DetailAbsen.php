<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DetailAbsen extends Model
{
    use HasFactory;

    protected $fillable = [
        'check',
        'status',
        'detail_status',
        'detail_check',
        'ip_address',
        'long',
        'lat',
        'location',
        'image'
    ];


    public function absensi ()
    {
        return $this->hasOne(Absensi::class, 'id', 'absensi_id');
    }

    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['image']);
    }
    

    /**
     * The field created_at change value datetime to timestamp epoch
     * @var datetime
     */
    public function getCreatedAtAtribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    /**
     * The field update_at change value datetime to timestamp epoch
     * @var datetime
     */
    public function getUpdateAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function checkIn($data, $absen)
    {
        /**
         * Condition presensi is hadir
         * @var absen->type
         * jika hadir maka status => sehat
         * jika hadir maka detail_status => status 
         * 
         * jika tidak hadir maka status => sesuai pilihan type kerja 
         * jika tidak hadir maka detail_status = sesuai isi keterangan
         * 
         * detail check merupakan isi jika terlambat
        */
        $status = $absen->type === 'hadir' ? 'sehat' : '';
        $data['detail_status'] === null ? $status : $data['detail_status'];

        
        $detailAbsensi                  = new DetailAbsen();
        $detailAbsensi->absensi_id      = $absen->id;
        $detailAbsensi->check           = 'in';
        $detailAbsensi->status          = $status;
        $detailAbsensi->lat             = $data['lat'];
        $detailAbsensi->long            = $data['long'];
        $detailAbsensi->location        = $data['location'];
        $detailAbsensi->detail_status   = $data['detail_status'];
        $detailAbsensi->detail_check    = $data['detail_check'];
        $detailAbsensi->image           = $data['image'];
        $detailAbsensi->save();

        return $detailAbsensi;
    }

    public function checkOut($data, $absen)
    {
        /**
         * Checkout 
         * untuk detail_status dan detail_check samakan dengan data dari check in 
         * @var detail_status = absen->detail->detail_status 
         * @var detail_check = absen->detail->detail_check 
         */
        $detailAbsensi                  = new DetailAbsen();
        $detailAbsensi->absensi_id      = $absen->id;
        $detailAbsensi->check           = 'out';
        $detailAbsensi->status          = $absen->detail->status;
        $detailAbsensi->lat             = $data['lat'];
        $detailAbsensi->long            = $data['long'];
        $detailAbsensi->location        = $data['location'];
        $detailAbsensi->detail_status   = $absen->detail->detail_status;
        $detailAbsensi->detail_check    = $absen->detail->detail_check;
        $detailAbsensi->image           = $data['image'];
        $detailAbsensi->save();

        return $detailAbsensi;
    }

    public function detailIjin($data, $absen_id)
    {
        $detailAbsensi = new DetailAbsen();

        
        return $detailAbsensi;
    }

    public function isPermit($data)
    {
        $detailAbsensi = new DetailAbsen();

        $detailAbsensi->absensi_id = '';
        $detailAbsensi->check = $data['check'];
        $detailAbsensi->status = $data['status'];
        $detailAbsensi->lat = $data['lat'];
        $detailAbsensi->long = $data['long'];
        $detailAbsensi->location = $data['location'];
        $detailAbsensi->detail_status = $data['detail_status'];
        $detailAbsensi->detail_check = $data['detail_check'];
        $detailAbsensi->save();
        
        return $detailAbsensi;
    }

    public function isSppd($data)
    {
        $detailAbsensi = new DetailAbsen();

        $detailAbsensi->absensi_id = '';
        $detailAbsensi->check = $data['check'];
        $detailAbsensi->status = $data['status'];
        $detailAbsensi->lat = $data['lat'];
        $detailAbsensi->long = $data['long'];
        $detailAbsensi->location = $data['location'];
        $detailAbsensi->detail_status = $data['detail_status'];
        $detailAbsensi->detail_check = $data['detail_check'];
        $detailAbsensi->save();
        
        return $detailAbsensi;
    }

    public function isPresent($data)
    {
        $detailAbsensi = new DetailAbsen();

        $detailAbsensi->absensi_id = '';
        $detailAbsensi->check = $data['check'];
        $detailAbsensi->status = $data['status'];
        $detailAbsensi->lat = $data['lat'];
        $detailAbsensi->long = $data['long'];
        $detailAbsensi->location = $data['location'];
        $detailAbsensi->detail_status = $data['detail_status'];
        $detailAbsensi->detail_check = $data['detail_check'];
        $detailAbsensi->save();
        
        return $detailAbsensi;
    }
}
