<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use phpDocumentor\Reflection\Types\Array_;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Получаем данные для таблицы
    //возвращаем array [name] [track] [status]
    public function getTable(){
        $user = Session::all();
        $login = $user['logged_user']->login;
        $temp = DB::table('orders')
            ->select('name', 'trackcode')
            ->where('user', "=", $login)
            ->get();
        //var_dump($temp);
        $result = Array();
        foreach ($temp as $foreach){
            $result[] = $foreach->name;
            $result[] = $foreach->trackcode;
            $result[] = "ожидает подтверждения";
        }
        $temp = DB::table('orders_accepted')
            ->select('name', 'trackcode')
            ->where('user', "=", $login)
            ->get();
        foreach ($temp as $foreach){
            $result[] = $foreach->name;
            $result[] = $foreach->trackcode;
            $result[] = "Ваша заявка принята";
        }
        $html = " <table>
            <tr>
               <td>Наименование товара</td>
                <td>Track-code товара</td>
                <td>Статус</td>
            </tr>
        ";
        for($i = 0; $i < count($result); $i += 3){
            $html = $html."<tr>
                            <td>".$result[$i]."</td>
                            <td>".$result[$i + 1]."</td>
                            <td>".$result[$i + 2]."</td><tr>";
        }
        $html = $html."</table>";
        //var_dump($html);
        return $html;
    }
    //Получаем данные для таблицы
    public function showPage($id){
        $user = Session::all();
        if(array_key_exists('logged_user', $user) == false){
            return redirect('/login');
            }
        else{
        return view('profile', ['id' => $id, 'track' => " ", 'table' => $this->getTable()]);
        }
    }
    public function showTrack($id){
        $user = Session::all();
        $data = $_POST;
        $track = $data['track'];
        $location = DB::table('orders_accepted')
            ->select('location')
            ->where('trackcode', '=', $track)
            ->first();
        if($location != NULL) {
            $ex_location = explode("#", $location->location);
            $login = DB::table('orders_accepted')
                ->select('user')
                ->where('trackcode', "=", $track)
                ->first();
            $trigger = false;
            /*$type = DB::table('registration')
                ->select('type')
                ->where('login', '=', $login->user)
                ->first(); */
            //var_dump($type->type);
            if ((($user['logged_user']->login) == ($login->user)) or ($user['logged_user']->type == "admin")) {
                $trigger = true;
            }
            return view('profile', ['location' => $ex_location, 'trigger' => $trigger, 'table' => $this->getTable()]);
        }
        return $this->showPage($id);
    }

    public function index()
    {
        //
        return view('profile', ['table' => $this->getTable()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
