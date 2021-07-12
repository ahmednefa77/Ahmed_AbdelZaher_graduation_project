<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fashion House</title>
    <link rel="icon" href="{{asset('images/logo.jfif')}}">

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js\jquery-3.5.1.min.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">

    </head>
<body>
<style>
    #rightsideul a {color: #AAA;}
    #rightsideul li {padding:10px;border:none;background-color: #DDD}
</style>
    <div id="app">
        <!-- Start upper header -->
        <nav class="navbar navbar-expand-md p-0 " style="font-size: 12px;background-color: #DDD;color:#AAA">
            <div class="container-fluid px-1 px-md-1 px-lg-5 ml-0">
                <label class="font-weight-normal my-auto d-none d-md-block col-md-6">
                    Free Shipping on All orders Over $75!
                </label>

                <div class="collapse navbar-collapse ml-0 " id="navbarSupportedContent" style="display: block">


                    <!-- Right Side Of Navbar -->
                    <ul class="ml-auto pr-0 pr-lg-0 list-group list-group-horizontal" id="rightsideul">
                        <!-- Authentication Links -->

                        @guest
                            <li class="list-group-item">
                                <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="list-group-item">
                                    <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                            <li class="list-group-item dropdown show">
                                <a id="dropdownMenuLink" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Myaccount
                                </a>


                                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                            @if( (session('role')))

                                    <a class="dropdown-item" href="{{route('showprofilert')}}">Profile</a>

                            @endif
                                    @if( (session('role')=="Admin" || session('role')=="Moderator"))

                                        <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>

                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="list-group-item">
                            <a class="" >Wishlist</a>
                        </li>

                        <!-- Currency drop down-menue -->
                    <li class="list-group-item">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" v-pre>
                            Currency:Usd
                        </a>

                    </li>
                        <!---Shopping pascket--->
                        <li class="list-group-item">

                            <a class="m-0 p-0" style="color:darkmagenta" href="{{route('showcarftitemsrt')}}"><i class="fas fa-shopping-cart mx-0"></i>My Carft(<span id="carftquantity"></span>)</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Start search header -->
        <article class="bg-white py-4 mx-auto ">
            <form action="{{route('searchproductnamert')}}" method="get" id="searchnameform"
                  class="mx-auto py-2 col-md-6 col-lg-4 col-xl-3 col-8" style="border:1px solid #AAA;border-radius:25px">
            <input type="text" class="bg-white border-1 border-right ml-5" name="searchname" style="width:70%;outline: none;border:none;font-size: 12px;" placeholder="Search Here What You Need...">
                <i class="fas fa-search pl-2"  id="searchproductnnameicon"style="color:#AAA;cursor: pointer"></i>
            </form>
        </article>
        <!-- Start Lower Header -->
        <section class="d-flex justify-content-between bg-black py-2 px-0" id="lowerheader">
            <!-- logo image -->
            <div class="ml-2 ml-lg-5">
                <img src="{{asset('images\logograduationproject.png')}}" height="50">
            </div>
            <!-- collapse button -->
            <!--<div class="btn-group d-block d-md-none dropstart">
                <label class="p-0 mr-3" data-toggle="dropdown" ><i class="fas fa-bars fa-3x"></i></label>-->

            <?php $categorysviewed=\App\Models\Category::where('viewinnav','view')->get() ?>
            <div class="btn-group d-md-none ">
                <label class="p-0 pr-2 mr-0" data-toggle="dropdown" ><i class="fas fa-bars fa-2x p-1"></i></label>

                   <ul class="dropdown-menu dropdown-menu-right bg-black p-0 m-0 text-center" role="menu" aria-labelledby="dLabel">
                        <li class="list-group-item p-1  bg-black" style="border:none">Blog</li>
                       @foreach($categorysviewed as $cat)
                           <li class="list-group-item p-1  bg-black" style="border:none"><a href="{{route('searchcategoryrt',$cat['id'])}}" style="color:#AAA">{{$cat['name']}}</a>
                           </li>
                       @endforeach
                       <li class="list-group-item p-1   bg-black" style="border:none;color:darkmagenta !important;"><a href="/">Home</a></li>

                    </ul>
                 </div>
            <!-- right ul -->

            <div style="" class="d-none d-md-block pr-0 pr-lg-3">
                <ul class="list-group list-group-horizontal ml-auto bg-black px-3 " style="direction: rtl;">
                    <li class="list-group-item mx-0 p-3 bg-black" style="border:none">Blog</li>
                    @foreach($categorysviewed as $cat)
                    <li class="list-group-item mx-0 p-3  bg-black" style="border:none;color:darkmagenta !important;">
                        <a href="{{route('searchcategoryrt',$cat['id'])}}" style="color :#FFF">{{$cat['name']}}</a></li>
                     @endforeach
                    <li class="list-group-item mx-0 p-3  bg-black" style="border:none;color:darkmagenta !important;">
                        <a href="/" style="color:darkmagenta">Home</a></li>

                </ul>

            </div>
        </section>

        <main class="">
            @yield('content')

        </main>
    </div>
<!--   Start Footer -->
<style>
    .footerlist li a ,.footerlist li {color: #aaa}
</style>
<?php $categorys=\App\Models\Category::all()?>

<main class="container-fluid">
    <section class="row p-5" style="background-color: #222">
        <!--left article -->
        <article class="col-6 col-md-3 pt-3">
            <div>
                <h6 class="text-white font-weight-bold">SHOPS</h6><br>
                <ul class="list-unstyled text-gray footerlist" style="color:#AAA">
                    <li>News</li>
                    @foreach($categorys as $cat)
                    <li><a  href="{{route('searchcategoryrt',$cat['id'])}}" >{{$cat['name']}}</a></li>
                    @endforeach
                    <li><a href="{{route('showoffersrt')}}">Sales & Special Offers</a></li>


                </ul>
            </div>
        </article>
        <!--middle article #2 -->
        <article class="col-6 col-md-3 pt-3">
            <div>
                <h6 class="text-white font-weight-bold">INFORMATION</h6><br>
                <ul class="list-unstyled text-gray footerlist" style="color:#AAA">
                    <li>About us</li>
                    <li><a href="#" >Customer Services</a></li>
                    <li><a href="#">New Collection</a></li>
                    <li><a href="#">Best Sellers</a></li>
                    <li>Manufacturers</li>
                    <li>Privacy policy</li>
                    <li><a href="#">Terms & condition</a></li>
                    <li>blog</li>

                </ul>
            </div>
        </article>
        <!--middle article #3 -->
        <article class="col-6 col-md-3 pt-3">
            <div>
                <h6 class="text-white font-weight-bold">CUSTOMER SERVICE</h6><br>
                <ul class="list-unstyled text-gray footerlist" style="color:#AAA">
                    <li>Search Terms</li>
                    <li><a href="#" >Advanced Search</a></li>
                    <li><a href="#">Orders and Returns</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li>RSS</li>
                    <li>Help & FAQs</li>
                    <li><a href="#">Consultant</a></li>
                    <li>Store Location</li>

                </ul>
            </div>
        </article>
        <!--Right article #4 -->
        <article class="col-6 col-md-3 pt-3">
            <div>
                <h6 class="text-white font-weight-bold">NEWSLETTER</h6>
                <ul class="list-unstyled text-gray footerlist" style="color:#AAA">
                    <li>Sign Up for News Letter</li>
                    <li class="mt-4 "><input type="text" placeholder="Type Your E-mail" class="bg-transparent text-center w-75" style="border:1px solid gray"></li>
                    <li class="mt-4 col-12 p-0 mb-2 "><input type="text" style="background-color: magenta;
                    color:white;text-align: center;font-weight: bold;font-size: 12px;width:75%;border:none;height: 30px" value="SUBSCRIBE"></li>
                    <li class="px-1">
                        <i class="fab fa-facebook-square fa-2x ml-1"></i>
                        <i class="fab fa-twitter-square fa-2x ml-1"></i>
                        <i class="fab fa-behance-square fa-2x ml-1"></i>
                        <i class="fab fa-tumblr-square fa-2x ml-1"></i>
                        <i class="fab fa-vimeo-square fa-2x ml-1"></i>
                        <i class="fab fa-youtube fa-2x ml-1"></i>
                    </li>
                </ul>
            </div>
        </article>

    </section>




</main>
<!-- the end footer -->
<main class="container-fluid p-4  bg-black ">
    <article class="row justify-content-around">
    <p class="ml-5 text-gray" style="font-size: 12px;">© 2014 ELLA Fashion Store Shopify. All Rights Reserved. Ecommerce Software by Shopify.</p>
    <img src="{{asset('images\page\endfooterimage.png')}}" style="height: 15px;" >
    </article>
</main>

</body>
<script>
    $(document).ready(function(){

        $('#carftquantity').text(localStorage.getItem('carftquantity'));
        $(".shoppingcarftbutton").on("click",function (e) {
            e.preventDefault();
           //alert(localStorage.getItem('carftquantity'));
            id=$(this).attr("data-id");
            $.ajax({
                type :"get",
                url : "{{route('addtocraftrt')}}",
                datatype : "json",
                data :{id:id},
                success : function(data)
                {
                    if(data.elementexists!=null) {alert("Item already Exists in Carft");return;}
                    alert("Item added to Carft successfully "+ data.carftitems);
                    $('#carftquantity').text(data.carftitems);
                    localStorage.setItem("carftquantity", data.carftitems);

                }
            })

        })
//search product by name
        $("#searchproductnnameicon").on("click",function () {
            $("#searchnameform").submit();
        })


    })
</script>
</html>
