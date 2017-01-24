<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPSR:Админинистрирование</title>
    <link rel="stylesheet" href="{{url("css/style_adm.css")}}">
    <link rel="icon" href="{{url("img/favicon.ico")}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{url("img/favicon.ico")}}" type="image/x-icon">
</head>
<body>
{!! csrf_field() !!}
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
<form action="/admin_panel" method="post">
    {!! csrf_field() !!}
    <input type="text" name="logo" class="set_logo">
    <input type="submit" value="установить" name="but_set_logo">
</form>
<div class="content">
<div class="expect">
    <div class="title"><p>Ожидают ответа</p></div>
     <?php
          foreach ($order as $orders){
               echo '
               <div class="order">
               <p class="name">Наименование заказа: '.$orders->name.'</p>
               <p class="track">Track-code заказа: '.$orders->trackcode.'</p>
               <p class="user">Login заказчика: '.$orders->user.'</p>
               <p class="user">Адрес заказчика: '.$orders->address.'</p>
               <p class="tel">Телефон заказчика: '.$orders->tel.'</p>
               <p class="delivery">Куда доставить: '.$orders->delivery.'</p>
               <p class="parcel_weight">Вес посылки: '.$orders->parcel_weight.'</p>
               <form action="/admin_panel" method="post">'.csrf_field().'
               <input type="hidden" name="order_trackcode" value="'.$orders->trackcode.'">
               <input type="submit" name="accept" value="принять" class="loc_but">
               <input type="submit" name="refuse" value="отказать" class="ref_but">
               </form>
                </div>';
          }
     ?>
</div>
<div class="accepted">
    <div class="title"><p>Принятые</p></div>
    <?php
    foreach ($order_acc as $order_acc1){
        echo '
               <div class="order">
               <p class="name">Наименование заказа: '.$order_acc1->name.'</p>
               <p class="track">Track-code заказа: '.$order_acc1->trackcode.'</p>
               <p class="user">Login заказчика: '.$order_acc1->user.'</p>
               <p class="user">Адрес заказчика: '.$order_acc1->address.'</p>
               <p class="tel">Телефон заказчика: '.$order_acc1->tel.'</p>
               <p class="delivery">Куда доставить: '.$order_acc1->delivery.'</p>
               <p class="parcel_weight">Вес посылки: '.$order_acc1->parcel_weight.'</p>
               <form action="/admin_panel" method="post">'.csrf_field().'
               <input type="hidden" name="order_trackcode" value="'.$order_acc1->trackcode.'">
               <strong>Тут указывать текущее местоположение: </strong><input type="text" name="get_loc" class="get_loc">
               <div></div>
               <input type="submit" name="set_loc" value="Указать" class="loc_but">
               <input type="submit" name="refuse_acc" value="Удалить" class="ref_but">
               </form>
                </div>';
    }
    ?>
</div>
</div>
</body>
</html>