<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    use HasFactory;

    protected $table = "subunits";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function employeeSubUnit()
    {
        return $this->hasMany(UserRoles::class, 'subunit_id', 'id');
    }
}
