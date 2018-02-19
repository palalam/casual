<?php
namespace App\Traits;
use DB;
use Auth;

trait Common
{

	public function getShop()//Повертає магазин юзера
	{
		//return DB::table('shops') ->where('shop_user_id', Auth::user() -> id) -> first();
		return $shop = DB::table('shops') ->where('shop_user_id', Auth::user() -> id) -> first();
	}

	
}