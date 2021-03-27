<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    public function index(){
//        $user = Auth::user();
//        dd($user);

//        Role::create(['name' => 'superadmin']);
//        Role::create(['name' => 'buyer']);

//        dd(auth()->user()->assignRole('buyer'));


        $books = DB::table('books')->orderBy('created_at')->paginate(6);

        return view('index', compact('books'));
    }
}
