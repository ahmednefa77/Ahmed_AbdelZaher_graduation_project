<?php $username=\Illuminate\Support\Facades\Auth::user()->name; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fashion House</title>
    <link rel="icon" href="{{asset('images/logo.jfif')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/')}}" class="nav-link">Home</a>
            </li>

        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3" >
            <div class="input-group input-group-sm" >
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" hidden>
                <div class="input-group-append" hidden>
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                {{-- Customize Show Form button--}}
                <div class="input-group-append">
                    <button class="btn btn-navbar ml-3" id="customizeshowformbutton" type="button" style="display:none">
                        Customize
                    </button>
                </div>
                {{-- Search Show Form button--}}
                <div class="input-group-append">
                    <button class="btn btn-navbar ml-3" id="deepsearchshowformbutton" type="button" style="display:none">
                        Deep Search
                    </button>
                </div>

            </div>
        </form>



        <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{asset('dist/img/AdminLTELogo.png')}}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Fashion House</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="height:90px">
                <div class="image">
                    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           {{$username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="color:darkgreen"  >
                            <a class="dropdown-item" href="{{ route('logout') }}" style="color:darkgreen"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                </div>
                </div>
                <div class="info">

                    {{--<a href="#" class="d-block">{{Auth::user()->name}}</a>--}}
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    {{--members --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                Members
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('showallusersrt')}}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Show All Members</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('showstoreuserformrt')}}" class="nav-link">
                                    <i class="fas fa-user-plus"></i>
                                    <p>Add New Member</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('showallprofilesrt')}}" class="nav-link">
                                    <i class="fas fa-user-plus"></i>
                                    <p>Show All Profiles</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                   {{-- ////////////////////////////////////////////////////////////--}}
                   {{--Start of Product--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fab fa-product-hunt"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('showallproductsrt')}}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Show All Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('showstoreproductformrt')}}" class="nav-link">
                                    <i class="fas fa-plus-square"></i>
                                    <p>Add New Product</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                   {{-- End of Product --}}
                    {{--Start of Category--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-coffee"></i>
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route("showallcategorysrt")}}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Show All Categories</p>
                                </a>
                            </li>
                            <li class="nav-item d-none">
                                <a href="{{asset('')}}index2.html" class="nav-link">
                                    <i class="fas fa-plus-square"></i>
                                    <p>Add New Category</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- End of Category --}}
                    {{--Start of Offer--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <p>
                                Offers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('showalloffersrt')}}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Show All Offers</p>
                                </a>
                            </li>
                            <li class="nav-item d-none">
                                <a href="{{asset('')}}index2.html" class="nav-link">
                                    <i class="fas fa-plus-square"></i>
                                    <p>Add New Offer</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- End of Offer --}}
                    {{--Start of Slider--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                               Slider
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('showallslidersrt')}}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Show All Sliders</p>
                                </a>
                            </li>
                            <li class="nav-item d-none">
                                <a href="{{asset('')}}index2.html" class="nav-link">
                                    <i class="fas fa-plus-square"></i>
                                    <p>Add New Slider</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- End of Slider --}}


                </ul>
            </nav>
            <!-- /.sidebar-menu -->

        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
       @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

        <strong>Copyright &copy; 2021 <a href="http://adminlte.io">BY Ahmed Abdel Zaher</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
@yield('myjquery')
</body>
</html>
