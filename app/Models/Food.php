<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'ingredients', 'price', 'rate', 'types', 'picturePath'
    ];

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

    /**
     * the function change name field database from camelCase to snackCase
     * 
     */
    public function toArray()
    {
        $toArray = parent::toArray();
        $toArray['picturePath'] = $this->picturePath;
        return $toArray;
    }

    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['picturePath']);
    }
}
