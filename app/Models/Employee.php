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
        'work_code'
    ];

    public function user(){

        return $this->belongsTo(User::class);


    }

    public function person(){

        return $this->belongsTo(Person::class);
    }
}


