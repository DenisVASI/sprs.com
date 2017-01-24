<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPSR:Новая заявка</title>
    <link rel="stylesheet" href="{{url("css/style_order.css")}}">
    <link rel="icon" href="{{url("img/favicon.ico")}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{url("img/favicon.ico")}}" type="image/x-icon">
</head>
<body>
    <?php

    function getTrack(){
        $track = '';
        $alp = explode(" ", "Q W E R T Y U I O P A S D F G H J K L Z X C V B N M");
        for ($i = 0; $i < 4; $i++){
            $rand = rand(0, 25);
            $track = $track.$alp[$rand];
        }
        $user = Session::all();
        $track = $track.($user['logged_user']->id + 584);
        //проверка на уникальность
        $order = DB::table("orders")->where('user', $user['logged_user']->login)->get();
        $trackcodes = Array();
        foreach ($order as $orders){
            $trackcodes[] = $orders->trackcode;
        }
        for($i = 0; $i < count($trackcodes);$i++){
            if($track == $trackcodes[$i]){
                getTrack();
            }
        }
        //конец проверки
        return $track;
    }
    function getName(){
        $user = Session::all();
        return $user['logged_user']->login;
    }
    ?>
    <!-- top panel-->
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
    <!-- top panel-->
    <div class="content">
    <form action="/new_order" method="post">
        {!! csrf_field() !!}
        <p>Имя товара</p>
        <input type="text" name="name" class="add_item">
        <p>Трек код товара</p>
        <input type="text" name="trackcode" value="<?php echo getTrack()?>" readonly class="add_item2">
        <p>Имя аккаунта</p>
        <input type="text" name="user" value="<?php echo getName()?>" readonly class="add_item2">
        <p>Адресс</p>
        <input type="text" name="address" class="add_item">
        <p>Телефон</p>
        <input type="text" name="tel" class="add_item"> <!--Добавить в миграции-->
        <p>Адрес доставки</p>
        <input type="text" name="delivery" class="add_item"> <!--Добавить в миграции-->
        <p>Вес посылки(указать мерную единицу)</p>
        <input type="text" name="parcel_weight" class="add_item"> <!--Добавить в миграции, вес посылки-->
        <div></div>
        <input type="submit" class="button">
    </form>
    </div>
</body>
</html>