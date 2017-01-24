<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AdminPanelController extends Controller
{
    //
    public function index(){
        $user = Session::all();
        $orders = DB::table('orders')->get();
        $orders_accepted = DB::table('orders_accepted')->get();
        if(array_key_exists('logged_user', $user) == false){
            return redirect('/login');
        }
        else if($user['logged_user']->type == "admin") {
            return view('admin_panel', ['order' => $orders, 'order_acc' => $orders_accepted]);
        }
        else{
            return redirect('/');
        }
    }
    public function orderProcessing(){
        $data = $_POST;
        if(isset($data['order_trackcode'])) {
            $user_data = DB::table('orders')->select()->where('trackcode', "=", $data['order_trackcode'])->first();
        }
        if (isset($data['accept'])){
            DB::table('orders_accepted')->insert(
                [
                    "name" => $user_data->name,
                    "trackcode" => $user_data->trackcode,
                    "user" => $user_data->user,
                    "address" => $user_data->address,
                    "tel" => $user_data->tel,
                    "delivery" => $user_data->delivery,
                    "location" => "Курьер забрал посылку#",
                    "parcel_weight" => $user_data->parcel_weight
                ]);
            DB::table('orders')->where('trackcode', '=', $data['order_trackcode'])->delete();
            return redirect('/admin_panel');
        }
        else if(isset($data['refuse'])){
            DB::table('orders')->where('trackcode', '=', $data['order_trackcode'])->delete();
            return redirect('/admin_panel');
        }
        else if(isset($data['set_loc'])) {
            $loc_data = DB::table('orders_accepted')->select('location')->where('trackcode', "=", $data['order_trackcode'])->first();
            $temp = $loc_data->location;
            $temp = $temp.$data['get_loc'].'#';
            DB::table('orders_accepted')
                ->where('trackcode',"=",$data['order_trackcode'])
                ->update(["location" => $temp]);
            return redirect('/admin_panel');
        }
        else if(isset($data['refuse_acc'])){
            DB::table('orders_accepted')->where('trackcode', '=', $data['order_trackcode'])->delete();
            return redirect('/admin_panel');
        }
        else if(isset($data['but_set_logo'])){
            DB::table('settings')->update(['logo_name' => $data['logo']]);
            return redirect('/admin_panel');
        }
    }
}
