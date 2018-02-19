<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Traits\Common;
use App\Obnova;
use App\Product;
use Illuminate\Http\File;
class ShopController extends Controller
{
    use Common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shop = $this -> getShop();
        

        if($shop) 
        {
            $obnovs = Obnova::where('obnova_user_id', Auth::user() -> id) -> where('obnova_shop_id',$shop -> shop_id) ->get();
            $products = [];//Тут буде масив з обновами в яких є продукти [назва обнови] => продукти
            foreach ($obnovs as $obnova) {//перебираємо обнови
                $products[$obnova -> obnova_name] = Product::where('product_obnova_id','=',$obnova -> obnova_id) -> get() -> all() ;//витягуєм продукти по ID обнови і записуєм в масив
            }

            return view('shop.my_shop',['shop' => $shop, 'products' => $products]);
        }
        else
        return view('shop.create');
    }

    public function create(Request $request)
    {
        $this -> validate($request, ['shop_name' => 'required|max:50|unique:shops']);
        $shop_name = $request->input('shop_name');
        if( DB::table('shops')->insert(['shop_user_id' => Auth::user()->id, 'shop_name' => $shop_name]) )
            return redirect()->route('my_shop');
    }
    

    public function newObnova()
    {

        return view('shop.add_products');
    }


    public function createObnova(Request $request)
    {
//        $files =[];
//        $path = $request->file('images');
//        foreach ($request -> file() as $file)
//        {
//            dump($file);
//
//            foreach ($file as $f)
//            {
//                $files[] = $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
//            }
//            //return "Успех";
//
//        }
//        dd($files);
//        exit;
//        dd($request -> file());

        $files = [];
        $kol = count($request -> file());
        for ($i=0; $i < $kol; $i++) 
        { 
            foreach($request -> file($i.'images') as $image)
            {
                $files[$i][] = $image->move(storage_path('images'), time().'_'.$image->getClientOriginalName()) -> getFileName();
            }
        }
    
        //////////////

        $shop_id = $this -> getShop() -> shop_id;

        if($request -> input('name'))
        {
            //Створюємо обнову
            $new_obnova = Obnova::create(['obnova_name' => $request -> input('obn_name'), 'obnova_shop_id' => $shop_id, 'obnova_user_id' => Auth::user() -> id]);
                  
            $inputs = [];//Масив з масивами значень з реквесту [input name] => array(values)
            $sqls=[];//Сюди циклом записуються початкові екземпляри запросів
            $name_values = [];
            $desc_values = [];

            //Цикл який записує в масив початкові екземпляри запросів
            for($l=0; $l<count($request -> input('name')); $l++)
            {
                array_push($sqls, 
                "INSERT INTO `products`(`product_title`,`product_desc`,`product_shop_id`,`product_obnova_id`,`product_photos`)
                 VALUES ('{@name@}','{@desc@}', '".$shop_id."' , '".$new_obnova -> id."', '".serialize($files[$l])."')"
                    );
            }
            //Цикл який бере з реквесту значення з інпутів і записує в масив вище
            foreach ($request -> input() as $input =>  $value) 
            {
                if($input == 'name')
                {
                    $inputs['name'] = $value;
                }
                if($input == 'desc')
                {
                    $inputs['desc'] = $value;
                }
            }

            //цикл який перебирає самі значення з інпутів і записує в масив
            foreach ($inputs as $input => $value) 
            {
                if($input == 'name')
                {
                    foreach ($value as $val) 
                    {
                        $name_values[] = $val;
                    }

                }
                if($input == 'desc')
                {
                    foreach ($value as $val) 
                    {
                        $desc_values[] = $val;
                    }
                }
            }
            //Цикл який заміняє в початкових екз запросів плейсхолдери на дані з інпутів
            for($b=0; $b<count($request -> input('name')); $b++)
            {
                $sqls[$b]=str_replace('{@name@}', $name_values[$b], $sqls[$b]);
                $sqls[$b]=str_replace('{@desc@}', $desc_values[$b], $sqls[$b]);
            }

        

            $rez_sql = null;
            foreach ($sqls as $sql) 
            {
                if(DB::insert($sql) == false)
                    $rez_sql=false;
                else
                    $rez_sql=true;
            }

            //якщо продукти не додалися в базу то видаляєм обнову
            if($rez_sql == false)
                Obnova::destroy($new_obnova -> id);
            else
            {
                //тут код після додавання продуктів і створення обнови
                return('Обнову додано!');
            }

        }//endif($request -> input('name'))

    }
    public function test()
    {
        return view('test');
    }
    public function testPost(Request $request)
    {
        //dd($request -> input());
        if($request -> input('name'))
        {


            $inputs = [];//Масив з масивами значень з реквесту [input name] => array(values)
            $sqls=[];//Сюди циклом записуються початкові екземпляри запросів
            $name_values = [];
            $desc_values = [];

            //Цикл який записує в масив початкові екземпляри запросів
            for($l=0; $l<count($request -> input('name')); $l++)
            {
                array_push($sqls, "INSERT INTO `test`( `name`, `description`) VALUES ('{@name@}','{@desc@}')");
            }

        
        //Цикл який бере з реквесту значення з інпутів і записує в масив вище
        foreach ($request -> input() as $input =>  $value) 
        {
            if($input == 'name')
            {
            $inputs['name'] = $value; 
            }
            if($input == 'desc')
            {
             $inputs['desc'] = $value;
            } 
        }
        //цикл який перебирає самі значення з інпутів і записує в масив
        foreach ($inputs as $input => $value) 
        {
            if($input == 'name')
            {
                foreach ($value as $val) 
                {
                    $name_values[] = $val;
                }

            }
            if($input == 'desc')
            {
                foreach ($value as $val) 
                {
                    $desc_values[] = $val;
                }
            }
        }
        //Цикл який заміняє в початкових екз запросів плейсхолдери на дані з інпутів
        for($b=0; $b<count($request -> input('name')); $b++)
        {
            $sqls[$b]=str_replace('{@name@}', $name_values[$b], $sqls[$b]);
            $sqls[$b]=str_replace('{@desc@}', $desc_values[$b], $sqls[$b]);
        }
    }//endif($request -> input('name'))

        $rez_sql = [];
        foreach ($sqls as $sql) 
        {
            $rez_sql[] = DB::insert($sql);
        }

        dd($rez_sql);
    }
    
}
