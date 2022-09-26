<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'address',
        'rg',
        'cpf'
    ];

    public function group() {
        return $this->belongsTo("App\Models\AdminGroup", "admin_group_id");    
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }



}
