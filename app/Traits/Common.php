<?php
namespace App\Traits;
use DB;

trait Common
{
	public function isAdmin($id)
	{
		return ( DB::table('users') -> where('id', $id) ->first()->is_admin ) ? true : false ;
	}
}