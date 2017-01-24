<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class NewOrderController extends Controller
{
    //
    public function createOrder(){
        $user = Session::all();
        if(array_key_exists('logged_user', $user) == false){
            return redirect('/login');
        }
        return view("new_order");
    }
    public function addOrder()
    {
        $data = $_POST;
        DB::insert('insert into orders (name, trackcode, user, address, tel, delivery, parcel_weight) VALUES (?,?,?,?,?,?,?)', [$data['name'], $data['trackcode'], $data['user'], $data['address'], $data['tel'], $data['delivery'], $data['parcel_weight']]);
        return view("new_order");
    }
}
