<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $guarded = [];
    protected $hidden = array('password', 'remember_token', 'email_verified_at','created_at', 'updated_at', 'deleted_at', 'leader_id','regional_id');


    public function getDataEmployee()
    {
        $data = Employee::all();
        return $data;
    }
}
