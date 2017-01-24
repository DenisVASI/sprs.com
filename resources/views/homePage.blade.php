<?php
use \Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>SPSR:Главная</title>
     <link rel="icon" href="{{url("img/favicon.ico")}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{url("img/favicon.ico")}}" type="image/x-icon">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{url('css/style_cont.css')}}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".slider").each(function() {

                var repeats = 5, // кількість повторювань автоматичного прокручування
                        interval = 3, // інтервал в секундах
                        repeat = true, // чи треба автоматично прокручувати (true/false)
                        slider = $(this),
                        repeatCount = 0,
                        elements = $(slider).find("li").length;

                $(slider)
                        .append("<div class='nav'></div>")
                        .find("li").each(function() {
                    $(slider).find(".nav").append("<span data-slide='"+$(this).index()+"'></span>");
                    $(this).attr("data-slide", $(this).index());
                })
                        .end()
                        .find("span").first().addClass("on");

                // add timeout

                if (repeat) {
                    repeat = setInterval(function() {
                        if (repeatCount >= repeats - 1) {
                            window.clearInterval(repeat);
                        }

                        var index = $(slider).find('.on').data("slide"),
                                nextIndex = index + 1 < elements ? index + 1 : 0;

                        sliderJS(nextIndex, slider);

                        repeatCount += 1;
                    }, interval * 1000);
                }

            });
        });

        function sliderJS(index, slider) { // slide
            var ul = $(slider).find("ul"),
                    bl = $(slider).find("li[data-slide=" + index + "]"),
                    step = $(bl).width();

            $(slider)
                    .find("span").removeClass("on")
                    .end()
                    .find("span[data-slide=" + index + "]").addClass("on");

            $(ul).animate({
                marginLeft: "-" + step * index
            }, 500);
        }

        $(document).on("click", ".slider .nav span", function(e) { // slider click navigate
            e.preventDefault();
            var slider = $(this).closest(".slider"),
                    index = $(this).data("slide");

            sliderJS(index, slider);
        });
    </script>
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
<div class="back">
    <div class="wrapper">
        <div class="slider">
            <ul>
                {{--<li><img src="{{url("img/i/1.png")}}"></li>--}}
                <li><img src="{{url("img/i/2.jpg")}}"></li>
                <li><img src="{{url("img/i/3.jpg")}}"></li>
                <li><img src="{{url("img/i/4.jpg")}}"></li>
                <li><img src="{{url("img/i/5.jpg")}}"></li>
            </ul>
        </div>
    </div>
</div>
<!--<div class="content">
    <div class="question">
        <p>Почему вам стоит выбрать нас?</p>
    </div>
    <div class="answers">
        <div class="answer">
            <img src="{{url("img/1.png")}}">
            <p>Качество</p>
        </div>
        <div class="answer">
            <img src="{{url("img/2.png")}}">
            <p>Надежность</p>
        </div>
        <div class="answer">
            <img src="{{url("img/3.png")}}">
            <p>Скорость</p>
        </div>
    </div>
</div> -->

<!--Новый content-->

<div class="grid">
    <figure class="effect-oscar">
        <img class = "back" src="img/29.jpg">
        <figcaption>
            <h2>Почему вам стоит работать с нами?</h2>
            <!--Понты-->
            <div class="ans">
                <p class="item">
                    <img src="{{url("img/1.png")}}">
                    <span>Качество</span>
                </p>
                <p class="item">
                    <img src="{{url("img/2.png")}}">
                    <span>Надежность</span>
                </p>
                <p class="item">
                    <img src="{{url("img/3.png")}}">
                <span>Скорость</span>
                </p>
            </div>
            <!--Понты-->
        </figcaption>
    </figure>
</div>
<!--Новый content-->
</body>
</html>