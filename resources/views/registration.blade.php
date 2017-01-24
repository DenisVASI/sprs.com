<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPSR:Регистрация</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url("css/style_reg.css")}}">
    <link rel="icon" href="{{url("img/favicon.ico")}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{url("img/favicon.ico")}}" type="image/x-icon">
</head>
<body>
<div class="top">
    <div class="logo">
        <?php
        $logo = DB::table('settings')->select('logo_name')->first();
        $logo_n = $logo->logo_name;
        ?>
        <a href="/admin_panel">{{$logo_n}}</a>
    </div>
    <div class="menu">
        <?php
        $user = Session::all();
        if(array_key_exists('logged_user', $user) == true){
            $address = "/".$user['logged_user']->id;
            $surname = $user['logged_user']->surname;
            $name = $user['logged_user']->name;
            echo "<div class='menu-item'><a href='".$address."'>".$name." ".$surname."</a></div>
                  <div class='menu-item'><a href='/'>Главная</a></div>
                  <div class='menu-item'><a href='/log_out'>Выход</a></div>";
        }
        else if(array_key_exists('logged_user', $user) == false){
            echo "<div class='menu-item'><a href='/login'>Вход</a></div>
            <div class='menu-item'><a href='/registration'>Регистрация</a></div>";
        }
        ?>
    </div>
</div>
<div class="all">
    <form action="/registration" method="post">
        {{csrf_field()}}
        <div class="table">
            <div class="regs"> Регистрация</div>
            <div>Логин</div>
            <input class="tab" type="text" name="reg_login">
            <div>Имя</div>
            <input class="tab" type="text" name="reg_name">
            <div>Фамилия</div>
            <input class="tab" type="text" name="reg_surname">
            <div>E-Mail</div>
            <input class="tab" type="emai" name="reg_email" value="standart@standart">
            <div>Пароль</div>
            <input class="tab" type="password" name="reg_password">
            <div>Повторите пароль</div>
            <input class="tab" type="password" name="reg_repeat_password">
            <input class="but" type="submit" value="Зарегистрировать">
        </div>
    </form>
</div>
</body>
</html>