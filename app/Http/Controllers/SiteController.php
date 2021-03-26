<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    public function index(){
//        $user = Auth::user();
//        dd($user);

//        Role::create(['name' => 'superadmin']);
//        Role::create(['name' => 'buyer']);

//        dd(auth()->user()->assignRole('superadmin'));

        return view('index');
    }
}
