<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets2/images/icons/favicon.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/vendor/lightbox2/css/lightbox.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets2/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets2/css/main.css')}}">
<!--===============================================================================================-->

</head>
<body class="animsition">

    <!-- Header -->
    <header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="topbar">
                <div class="topbar-social">
                    <a href="#" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
                    <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                    <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                    <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                </div>

                <span class="topbar-child1">
                    Free shipping for standard order over $100
                </span>

               
            </div>

            <div class="wrap_header">
                <!-- Logo -->
                <a href="{{url('home')}}" class="logo">
                    <img src="{{url('assets2/images/icons/logo.png')}}" alt="IMG-LOGO">
                </a>

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="{{url('home')}}">Home</a>
                                
                            </li>

                            <li>
                                <a href="{{route('product')}}">Shop</a>
                            </li>

                            <li class="sale-noti">
                                <a href="{{route('product')}}">Sale</a>
                            </li>

                            <li>
                                <a href="{{route('card')}}">Card</a>
                            </li>

                            <li>
                                <a href="{{route('about')}}">About</a>
                            </li>

                            <li>
                                <a href="{{route('contact')}}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">
                 <div class="user-area dropdown" >
                    <a href="#" class="header-wrapicon1 dis-block" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('images/avatar/', Auth::user()->image)}}" class="header-icon1" alt="ICON"  style="border-radius: 50% ;height: 40px; width: 40px;">
                    </a>
                    <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="{{route('my_profile')}}"><i class="fa fa- user"></i>My Profile</a>
                                <a  class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </div>
                   </div>
<span class="linedivide1"></span>
                   @php 
                   $count = 0;
                   foreach($all_cards as $card)
                   {
                    $count++;
                   }
                   @endphp
                  
                    <div class="header-wrapicon2">
                        <img src="assets2/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{$count}}</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                               
                            @foreach($all_cards as $card)
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/avatar/{{$card->property->image}}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="{{route('product_details',$card->property->id)}}" class="header-cart-item-name">
                                          {{$card->property->category}}
                                        </a>

                                        <span class="header-cart-item-info">
                                            {{$card->property->price}}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                          
                            </ul>

                            <div class="header-cart-total">
                                Total: $75.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="index.html" class="logo-mobile">
                <img src="assets2/images/icons/logo.png" alt="IMG-LOGO">
            </a>

            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <a href="SS" class="header-wrapicon1 dis-block">
                        <img src="images/avatar/{{Auth::user()->image}}" class="header-icon1" alt="ICON">
                    </a>

                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="assets2/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">0</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{url('assets2/images/item-cart-01.jpg')}}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            White Shirt With Pleat Detail Back
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $19.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{url('assets2/images/item-cart-02.jpg')}}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Converse All Star Hi Black Canvas
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $39.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{url('assets2/images/item-cart-03.jpg')}}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Nixon Porter Leather Watch In Tan
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $17.00
                                        </span>
                                    </div>
                                </li>
                            </ul>

                            <div class="header-cart-total">
                                Total: $75.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="wrap-side-menu" >
            <nav class="side-menu">
                <ul class="main-menu">
                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <span class="topbar-child1">
                            Free shipping for standard order over $100
                        </span>
                    </li>

                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <div class="topbar-child2-mobile">
                            <span class="topbar-email">
                                fashe@example.com
                            </span>

                            <div class="topbar-language rs1-select2">
                                <select class="selection-1" name="time">
                                    <option>USD</option>
                                    <option>EUR</option>
                                </select>
                            </div>
                        </div>
                    </li>

                    <li class="item-topbar-mobile p-l-10">
                        <div class="topbar-social-mobile">
                            <a href="#" class="topbar-social-item fa fa-facebook"></a>
                            <a href="#" class="topbar-social-item fa fa-instagram"></a>
                            <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                            <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                            <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                        </div>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="index.html">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Homepage V1</a></li>
                            <li><a href="home-02.html">Homepage V2</a></li>
                            <li><a href="home-03.html">Homepage V3</a></li>
                        </ul>
                        <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="product.html">Shop</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="product.html">Sale</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="cart.html">Features</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="blog.html">Blog</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="about.html">About</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

<div class="container" id ="set" style="background-color: #f2f2f2; margin-bottom: 50px;">
     <div style="margin: 50px ;border-bottom:2px solid #bfbfbf;">

@if(strlen($errors) >2)
    <div class="alert alert-danger">
        <ul>
        
                <li>{{ $errors }}</li>
        </ul>
    </div>
@endif 

     <h1 class="text-center"> Edit my profile </h1> 
     </div>
     <div style="margin: 50px ; text-align: center;">
                <h1>{{ $user->name }}'s Profile</h1>
 
     </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <form enctype="multipart/form-data" action="/my_profile" method="POST">

            <label for="usr"><h3>Full Name  : </h3>
             </label>
           <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" style="margin-left: 150px; margin-top: -50px ;margin-bottom: 50px ">
           <label for="usr"><h3>Profile Photo : </h3>
             </label>
            <img src="../images/avatar/{{ $user->image }}" style="width:150px; height:150px; margin-left: 50px ;border :2px solid #bfbfbf;" id="blah">
                <input type="file" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                <br> 
                <br>
                <div> 
                    <label for="usr"><h3> Password  : </h3> </label><br>  
                    <div class="row">
                    <label class="col-md-4 " style="font-size: 18px">Current password </label>
                    <label class="col-md-4" style="font-size: 18px">New password </label>
                    <label class="col-md-4" style="font-size: 18px" >Retype password </label>
                </div>
                    <input type="password" name="current_pass">
                    <input type="password" name="new_pass" >
                    <input type="password" name="Retype_pass">
                </div> 

                <br> 
                <br> 

                  <label for="name" class="col-md-4 control-label"> 
                    <h3> Gender </h3>
                 </label>

                 <select name="gender" class="col-md-4 control-label" value = "{{$user->gender}}">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                  </select>
                                
             <input type="submit" class="pull btn btn-info" value="submit" style="margin-left: 450px; margin-top: 100px; margin-bottom: 50px;">
            </form>
        </div>
        </div>

   
</div>
@include('pages_user.footer')