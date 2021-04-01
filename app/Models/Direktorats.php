<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direktorats extends Model
{
    use HasFactory;

    protected $table = "direktorats";
    protected $guarded = [];
    protected $primaryKey = 'id';


    public function units()
    {
        return $this->hasMany(Units::class, 'direktorat_id','id');
    }

    public function employeeDir()
    {
        return $this->hasMany(UserRoles::class, 'direktorat_id', 'id');
    }

}
