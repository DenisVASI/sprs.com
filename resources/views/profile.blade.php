<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPSR:Профиль</title>
    <link rel="stylesheet" href="{{url("css/style_prof.css")}}">
    <link rel="icon" href="{{url("img/favicon.ico")}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{url("img/favicon.ico")}}" type="image/x-icon">
</head>
<body>
<!--top panel-->
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
    <!--top panel-->
    </div>
</div>
    <div class="new_order">
        <a href="/new_order" class="button">Оставить заявку на доставку</a>
    </div>
    <?php
            $address = "";
            $user = Session::all();
            if(array_key_exists('logged_user', $user) == true){
                $address = "/".$user['logged_user'] -> id;
            }
    ?>
    <div class="ordersTable">
        {!!$table!!}
        <!--ЫЫЫЫЫ-ыы-->
        <!--SSSSS-->
    </div>
    <div class="check_order">
        <div class="check_form">
            <p>1.Введите ваш трек-код для проверки статуса вашей посылки</p>
            <form action="{{$address}}" method="post">
                {!! csrf_field() !!}
                <input type="text" name="track" class="get_location">
                <input type="submit" class="but_get_loc">
            </form>
            <p>2.Тут вы увидите путь, пройденый вашей посылкой:</p>
            <?php
                if(isset($location) and $trigger == true){
                    for($i = 0; $i < count($location) - 1;$i++){
                        echo '
                            <div class="loc_div">
                                <p>'.$location[$i].'</p>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>