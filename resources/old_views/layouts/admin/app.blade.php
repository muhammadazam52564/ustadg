<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /*  */
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        ul{
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li a{
            display: block;
            width: 100%;
            font-size: 18px;
            color: inherit;
            text-decoration: none;
            padding: 5px 15px;
            background-color: transparent;
            text-decoration: none;
            margin-bottom: 2px;
        }
        #label{
            display: block;
            width: 100%;
            font-size: 18px;
            color: inherit;
            text-decoration: none;
            padding: 5px 15px;
            background-color: transparent;
            text-decoration: none;
            color: #ff1e05;
            cursor: pointer;
            margin-bottom: 2px;
        }
        .active{
            background-image: linear-gradient(to right, #f07630, #eb212a);
            color: #fff !important;
        }
        li a:hover {
            color: inherit;
            font-weight: bold;
            text-decoration: none;
        }
        /*  */
        #sidebar{
            background-color: #fff;
            width: 280px;
            box-shadow: 1px 0 8px -3px #888;
            min-height: 100vh;
            position: fixed;
        }
        #main_area{
            background-color: #ffffff;
            width: calc(100% - 280px);
            min-height: 100vh;
            position: absolute;
            margin-left: 280px;
        }
        #header{
            background-color: #6200ff;
            padding-bottom: 100px;
            border-radius: 0px 0px 25px 25px;
        }
        #btn-open{
            font-size: 26px;
            color: #fff;
            cursor: pointer;
            display: none;
        }
        #btn-close{
            font-size: 26px;
            color: #747875;
            position: absolute;
            right: 15px;
            top: 10px;
            cursor: pointer;
            display: none;
        }
        #content-area{
            margin-top: -70px;
        }
        .bg-light-custom{
            background-color: rgb(250, 250, 250);
        }
        #menu_area{
            height: 400px;
        }
        #spacing{
            height: calc(100vh - 500px);
        }
        #logout_area{
            height: 60px;
        }
        .custom_card_1{
            background-color: #4287f5;
            color: #fff;
            height: fit-content;
            padding: 2px 20px;
        }
        .custom_card_2{
            background-color: #4b5c06;
            color: #fff;
            height: fit-content;
            padding: 2px 20px;
        }
        .custom_card_3{
            background-color: #331fed;
            color: #fff;
            height: fit-content;
            padding: 2px 20px;
        }
        .custom_card_4{
            background-color: #51a82f;
            color: #fff;
            height: fit-content;
            padding: 2px 20px;
        }
        @media only screen and (max-width: 1200px) {
            #sidebar{
                width: 270px;
            }
            #main_area{
                width: calc(100% - 270px);
                margin-left: 270px;
            }
        }
        @media only screen and  (max-width: 991px) {
            #sidebar{
                width: 280px;
                margin-left: -280px;
            }
            #main_area{
                width:100%;
                margin-left: 0;
            }
            #btn-open{
            display: block;
            }
            #btn-close{
                display: block;
            }
        }
        @media only screen and (max-width: 319px) {
            #sidebar{
                width: 270px;
            }
        }
    </style>
</head>
<body>
    <div id="main_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-3" id="header">
                    <!-- header -->
                    <div class="row">
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <div>
                                <i class="fa fa-bars" id="btn-open"></i>
                            </div>
                            <div>
                                <img class="rounded-circle" src="https://picsum.photos/50/50" width="50px" height="50px">
                                <b class="ml-2 text-white" style="line-height: 40px; font-size:22px">Admin</b>
                            </div>
                        </div>
                    </div>
                    <!-- header end -->
                </div>
                <div class="col-12 px-4" id="content-area">
                    <!-- Content  -->
                    <div class="row px-3">
                        <div class="col-12 rounded p-3 bg-light-custom">
                            @yield('content')
                        </div>
                    </div>
                    <!-- Content end -->
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pt-3">
                    <i class="fa fa-times" id="btn-close"></i>
                    @include('layouts.admin.nav')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $( document ).ready(function() {
            $("#btn-open").click(()=>{
                $('#sidebar').animate({marginLeft: "0px"});
            })
            $("#btn-close").click(()=>{
                $('#sidebar').animate({marginLeft: "-300px"});
            })
        });
        $(document).ready(function() {
            var path = window.location.pathname
            if(path == '/admin/dashboard')
            {
                $('#dashboard').addClass('active')
                $('#categories').removeClass('active')
                $('#orders').removeClass('active')

            }
            else if(path == '/admin/categories')
            {
                $('#dashboard').removeClass('active')
                $('#categories').addClass('active')
                $('#orders').removeClass('active')

            }
            else if(path == '/admin/orders')
            {
                $('#dashboard').removeClass('active')
                $('#categories').removeClass('active')
                $('#orders').addClass('active')
            }
        });




        // $.ajax({
        //     type: "GET",
        //     url: "https://jsonplaceholder.typicode.com/posts/1",
        //     cache: false,
        //     success: function(data){
        //         console.log(data);
        //         alert("ok")
        //     }
        // });
    </script>
</body>
</html>
