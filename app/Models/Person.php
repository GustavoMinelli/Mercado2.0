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
}
