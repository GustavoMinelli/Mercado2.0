<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'rg',
        'phone',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function employeeroles(){
        return $this->belongsTo(EmployeeRoles::class);
    }

    public function group() {
        return $this->belongsTo("App\Models\AdminGroup", "admin_group_id");    
    }


}


