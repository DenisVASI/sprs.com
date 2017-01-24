<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
class RegistrationController extends Controller
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
            return view("registration");
        } else {
            return redirect('/');
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
        $data = $_POST;
        $errors = array();
        if($data['reg_password'] != $data['reg_repeat_password']) {
            $errors[] = "Пароли не совпадают";
        }
        if(ctype_space($data['reg_login']) == true){
            $errors[] = "Логин не может содержать пробелы";
        }
        if(
        strlen($data['reg_login']) == 0 or
        strlen($data['reg_name']) == 0 or
        strlen($data['reg_surname']) == 0 or
        strlen($data['reg_password']) == 0 or
        strlen($data['reg_email']) == 0
        ){
            $errors[] = "Поля не могут оставаться пустыми!";
        }
        if(count($errors) == 0){
            DB::insert('insert into registration (login, name, surname, password, email) values (?,?,?,?,?)', [$data['reg_login'], $data['reg_name'], $data['reg_surname'], password_hash($data['reg_password'], PASSWORD_DEFAULT), $data['reg_email']]);
            return redirect('/login');
        }
        else{
            return redirect('/registration');
        }
    }
}
