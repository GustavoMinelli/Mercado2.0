<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'rg',
        'cpf',
        'phone',
        'gender',
        'adress',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customer(){
        return $this->hasOne(Customer::class);
    }
    public function employee(){
        return $this->hasOne(Employee::class);
    }
    public function manager(){
        return $this->hasOne(Manager::class);
    }

}
