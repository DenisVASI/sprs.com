<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $session = Session::all();
        if(array_key_exists('logged_user', $session) == false) {
            return view("login");
        } else {
            return redirect('/');
        }
    }
    public function loginUser(){
        $data = $_POST;
        $user = DB::table('registration')->where('login', $data['login'])->first();
        $errors = Array();
            if ($user != NULL) {
                if (password_verify($data['password'], $user->password) == false) {
                    /* if ($user->type == "user") {
                        session(["logged_user" => $user]);
                        $address = '/' . $user->id;
                        return redirect($address);
                    } else if ($user->type == "admin") {
                        session(["logged_user" => $user]);
                        $address = '/admin_panel';
                        return redirect($address);
                    } */
                    $errors[] = "Некорректный пароль";
                    return redirect('/login');
                }
                if(count($errors) == 0){
                    if ($user->type == "user") {
                        session(["logged_user" => $user]);
                        $address = '/' . $user->id;
                        return redirect($address);
                    } else if ($user->type == "admin") {
                        session(["logged_user" => $user]);
                        $address = '/admin_panel';
                        return redirect($address);
                }
                }

        }else{
                return redirect('/login');
        }
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
