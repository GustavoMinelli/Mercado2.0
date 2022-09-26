<?php

namespace App\Models;

use App\Enums\GroupEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    // use HasFactory;

    protected $table = 'admin_groups';
    public $timestamps = false;

    private $roles = [
        GroupEnum::ADMIN => ["*"],
        GroupEnum::EMPLOYEE => ["*"],
        GroupEnum::CUSTOMER => ["*"],    
    ];

    private $menu = [

        ["name" => "Home", "items" => [
            ["name" => "index", "url" => "index"]
        ]],
        
        ["name" => "Clientes", "url" => "customers", "role"=>"customer.index" ],
        ["name" => "Funcionarios", "url" => "employees", "role" => "employee.index" ], 

    ];
    
    public function menu(){

        $adminMenu = [];

        foreach($this->menu as $group) {

            $currentGroup = $group;
            $currentGroup["items"] = [];

            foreach ($group["items"] as $item) {

                if ($this->hasPermission($item["role"])) {
                    array_push($currentGroup["items"], $item);

                }

                array_push($adminMenu, $currentGroup);
            }
            return $adminMenu;
        }
    }

    public function hasPermission($role) {

            $adminRoles = $this->roles[$this->id];

            if(in_array("*", $adminRoles)) {
                return true;

            } else {
                    $roleRoute = explode(".", $role);

                    if(in_array($roleRoute[0].".*", $adminRoles) || in_array($role, $adminRoles)) {
                        return true;
                    } else {
                        return false;
                    }

            }

    }
}
