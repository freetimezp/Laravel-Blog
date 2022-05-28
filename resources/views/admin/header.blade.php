<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin panel</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{url('assets/admin/css/bootstrap.css')}}" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="{{url('assets/admin/css/font-awesome.css')}}" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="{{url('assets/admin/css/custom.css')}}" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>


<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav header-main-top">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="header-logo">
                    <img src="{{url('assets/admin/img/logo.png')}}" alt="blog"/>
                </a>
            </div>

            <div class="header-btns">
                <a href="{{url('/')}}" style="color:#fff; margin-right: 20px;">Website</a>
                <div class="header-btns-auth">
                    @auth
                        <a href="#">Hi, <span>{{Auth::user()->name}}</span></a>
                    @endauth
                    <a href="{{url('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /. NAV TOP  -->
