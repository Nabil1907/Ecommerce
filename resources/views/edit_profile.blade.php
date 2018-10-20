<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ecommerce</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ url('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/cs-skin-elastic.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{url('assets/scss/style.css')}}">
    <link href="{{url('assets/css/lib/vector-map/jqvmap.min.css')}}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('home')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('user_tables')}}">Users Table</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('admin_tables')}}">Admin Table</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('product_table')}}">Product Table</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('featured_product_table')}}">Featured Product Table</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-th"></i>
                                <a href="{{route('add_property')}}">Add Property Form</a>
                            </li> 
                            <li>
                                <i class="menu-icon fa fa-th"></i>
                                <a href="{{route('add_featured_product')}}">Add Featured Property Form</a>
                            </li>
                        </ul>
                    </li>

                

                   
                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('register_ad')}}">Register</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../images/avatar/{{Auth::user()->image}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="{{route('view_profile',Auth::user()->id)}}"><i class="fa fa- user"></i>My Profile</a>
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

                   

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

<div class="container" id ="set" style="background-color: #f2f2f2;">
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
        <form enctype="multipart/form-data" action="/edit_profile" method="POST">

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
                    <label for="usr"><h3> Password  : </h3> <br>  
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

                 <select name="gender" class="col-md-4 control-label" id="mySelect" >
                                    <option value="male">Male</option>
                                    <option value="female" >Female</option>
                                </select>
                                
             <input type="submit" class="pull btn btn-info" value="submit" style="margin-left: 450px; margin-top: 100px; margin-bottom: 50px;">
            </form>
        </div>
        </div>

   
</div>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
    <script type="text/javascript">
       
    document.getElementById("mySelect").value = "{{$user->gender}}" ;

    </script>
</body>
</html>
