<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $hidden = array(
        'created_at',
        'updated_at',
        'deleted_at',
        'is_pgs',
    );

    public function userRoles()
    {
        return $this->hasOne(Employee::class, 'id','user_id');
    }

    public function userPositions()
    {
        return $this->hasOne(Position::class, 'id','position_id');
    }
}
