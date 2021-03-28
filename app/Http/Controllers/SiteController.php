<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    public function index(Request $request){
//        $user = Auth::user();
//        dd($user);

//        Role::create(['name' => 'superadmin']);
//        Role::create(['name' => 'buyer']);

//        dd(auth()->user()->assignRole('buyer'));
//        \Cart::clear();
//        \Cart::session(auth()->user()->id)->clear();

        $books = Books::with(['authors'])->orderBy('created_at');
        $booksFilter = $books->get();
        $booksPaginated = $books->paginate(6);
        if (Auth::check()) {
            $userId = auth()->user()->id;
        }else{
            $userId = 'guest';
        }



        $authors = DB::table('authors')->get();

        if ($request->isMethod('post')) {
            $books = Books::with(['authors']);
//            dd($request->input());
            if(!empty($request->input('authorId'))){
                $books->where('author_id', $request->input('authorId'));
            }
            if(!empty($request->input('bookId'))){
                $books->where('id', $request->input('bookId'));
            }
            $booksPaginated = $books->paginate(6);


            return view('index', compact('booksFilter', 'booksPaginated', 'authors', 'userId'));
        }




        return view('index', compact('booksFilter', 'booksPaginated', 'authors', 'userId'));
    }

    public function addCart(Request $request){

//print_r($request->input());
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $request->input('book_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'attributes' => [
                'description' => $request->input('desc')
            ],
            'quantity' => 1
        ));

    }

    public function getCartContent(){
        \Cart::session(auth()->user()->id);

//        \Cart::clear();
//        \Cart::session(auth()->user()->id)->clear();
//        dd(\Cart::session(auth()->user()->id)->getContent());
        $cartItems = \Cart::getContent();

        return view('getcartcontent', compact('cartItems'));
    }
}
