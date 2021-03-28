<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    public function index(Request $request){


//        Role::create(['name' => 'superadmin']);
//        Role::create(['name' => 'buyer']);

//        dd(auth()->user()->assignRole('superadmin'));
//        dd(auth()->user()->assignRole('buyer'));


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

        $cartItems = \Cart::getContent();

        return view('getcartcontent', compact('cartItems'));
    }

    public function checkout(Request $request){

        $id = DB::table('orders')->insertGetId([
            'total' => $request->input('total'),
            'status' => 0,
            'user_id' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach ($request->input('products') as $item){
            DB::table('book_orders')->insert([
                'order_id' => $id,
                'book_id' => $item,
                'quantity' => 1,
                'sum' => DB::table('books')->where('id', $item)->value('price')
            ]);
        }
        \Cart::clear();
        \Cart::session(auth()->user()->id)->clear();
        return redirect('success');
    }

    public function success(){


        return view('success');
    }

    public function dashboard(){
        $orders = Orders::with('users', 'books')->where('user_id', auth()->user()->id)->get();
        $allOrders = Orders::with('users', 'books')->get();

        return view('dashboard', compact('orders', 'allOrders'));
    }
}
