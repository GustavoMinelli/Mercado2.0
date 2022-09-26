<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = "admin_users";
    protected $guard = "admin";

    protected $fillable = ["email", "password"];

    protected $hidden = ["password", "remember_token"];

    /**
     * Obtém o grupo do usuário
     */
    public function group() {
        return $this->belongsTo("App\Models\AdminGroup", "admin_group_id");    
    }

    //Retorna a lista de acordo com os parâmetros de busca
    public function scopeSearch($query, $search) {

        $query->from("admin_users as au");

        $query->select("au.*", "ag.name as admin_group_name");

        $query->join("admin_groups as ag", "ag.id", "au.admin_group_id");

        if ($search) {

            $searchColumns = [
                "au.name", "au.email", "ag.name"
            ];

            querySearch($query, $search, $searchColumns);

        }

        return $query;
    }
    
}

