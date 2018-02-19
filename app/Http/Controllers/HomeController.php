<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Traits\Common;
use App\Obnova;
use App\Product;
class HomeController extends Controller
{
    use Common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = $this -> getShop();

            $obnovs = Obnova::get();

            $products = [];//Тут буде масив з обновами в яких є продукти [назва обнови] => продукти
            foreach ($obnovs as $obnova) {//перебираємо обнови
                $products[$obnova -> obnova_name] = Product::where('product_obnova_id','=',$obnova -> obnova_id) -> get() -> all() ;//витягуєм продукти по ID обнови і записуєм в масив
            }
        return view('home',['shop' => $shop, 'products' => $products]);
    }

    public function view($id)
    {
        $product = Product::find($id);
        return view('view',['product' => $product]);
    }

    public function cabinet()
    {
        //dd(User::where('id', Auth::user() -> id) -> first());
        //return view('cabinet') -> with('user', User -> id = );
    }
    public function search(Request $request)
    {
        //dd($request -> input('search_text'));
        $input_text = $request -> input('search_text');
        $products = Product::where('product_title','LIKE', "%$input_text%") -> get();
        return view('result_search', ['products' => $products]);
    }


}
