<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'food_id', 'user_id', 'quantity', 'total', 'status', 'payment_url'
    ];

    public function food()
    {
        return $this->hasOne(Food::class, 'id','food_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
}
