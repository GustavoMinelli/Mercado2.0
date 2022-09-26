<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    Public function index(){
        
        // $permissions = [
        //     "create" =>hasPermission("admin-user.create"),
        //     "read" =>hasPermission("admin-user.read"),

        // ];

        $data = [
            // 'permissions' => $permissions,
        ];

        return view("admin.pages.admin-user.index", $data);
    }
}
