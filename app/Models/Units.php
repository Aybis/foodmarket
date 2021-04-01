<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;
    protected $table = "units";
    protected $guarded = [];
    protected $primaryKey = 'id';


    public function SubUnits()
    {
        return $this->hasMany(SubUnit::class, 'unit_id','id');
    }

    public function direktorat()
    {
        return $this->belongsTo(Direktorats::class);
    }

    public function employeeUnit()
    {
        return $this->hasMany(UserRoles::class, 'unit_id', 'id');
    }

}
