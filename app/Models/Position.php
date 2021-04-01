<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $guarded = [];
    protected $hidden = array('created_at','deleted_at','updated_at');

    public function positionHasRoles()
    {
        return $this->belongsTo(UserRoles::class);
    }

}
