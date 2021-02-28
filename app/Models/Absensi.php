<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'work',
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function detail()
    {
        return $this->belongsTo(DetailAbsen::class, 'id', 'absensi_id');
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

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function checkIn($data)
    {
        $model = new Absensi();

        $model->user_id     = $data['user_id'];
        $model->type        = $data['type'];
        $model->work        = $data['work'];
        $model->save();

        return $model;
    }

    public function checkOut($data)
    {
        $model = new Absensi();

        $model->user_id     = $data['user_id'];
        $model->type        = $data['type'];
        $model->work        = $data['work'];
        $model->save();

        return $model;
    }

    public function checkIjin($data)
    {
        $model = new Absensi();
        $modelDetailAbsensi = new DetailAbsen();

        for ($i=0; $i < $data['count_days']; $i++) { 
            $model->user_id = $data['user_id'];
            $model->type = $data['type'];
            $model->save();

            return $modelDetailAbsensi->detailIjin($data, $model);
        }

       

        return $model;
    }

    public function checkSakit($data)
    {
        $model = new Absensi();

        $model->user_id = $data['user_id'];
        $model->type = $data['hadir'];
        $model->work = $data['work'];
        $model->save();

        return $model;
    }

    public function checkSppd($data)
    {
        $model = new Absensi();

        $model->user_id = $data['user_id'];
        $model->type = $data['hadir'];
        $model->work = $data['work'];
        $model->save();

        return $model;
    }

}
