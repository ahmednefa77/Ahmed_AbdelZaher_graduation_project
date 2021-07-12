@extends('layouts.app')
        <!-- Styles -->


@section('content')
    <?php $sliders=\App\Models\Slider::all();$num=0;?>
   <div id="carouselExampleIndicators" class="carousel slide pt-0 mt-0"  data-ride="carousel">

        <div class="carousel-inner pt-0 mt-0" >
            @foreach($sliders as $slider)
                @if($num++ ==0)
                    <div class="carousel-item active" >
                @else
                    <div class="carousel-item " style="margin-top: 0;padding-top: 0">
                @endif
                    <img class="d-block w-100" src="{{asset('images\sliders\\'.$slider['image'])}}"  height="550" alt="First slide">

            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
           <!-- <span class="carousel-control-prev-icon text-danger" style="opacity:1;color: black !important;" aria-hidden="true"></span>

            -->
            <i class="fas fa-chevron-left fa-1x "
               style="border: 1px solid black;border-radius: 50%;color:black;height: 40px;width:40px;line-height: 40px"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="fas fa-chevron-right fa-1x "
               style="border: 1px solid black;border-radius: 50%;color:black;height: 40px;width:40px;line-height: 40px"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
<!--   Start the section lower to slider -->
       <main class="container">
           <article class="row pt-3">
               <!--left section -->
               <aside class="col-12 col-md-7">
                   <div class="pt-4">
                <img class="col-12" src="{{asset('images\page\upperleftimage.png')}}">
                       <h6 class="mt-2"
                          style="color:#e680e0;letter-spacing: 10px;font-size: 30px">Hot Collection</h6>
                   <h1 class="font-weight-bolder" style="color:#444;margin: 0;padding: 0">New Trend For Women</h1>
                       <p class="text-gray w-100">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                      <button class="p-2 w-25" >Shop Now</button>

                   </div>
               </aside>

               <!--right section -->
               <aside class="col-md-5 col-12">
                 <div class="pt-4">
                     <img class="col-12 " src="{{asset('images\page\upperrightupperimage.png')}}">
                     <img class="mt-5 pt-4 col-12" src="{{asset('images\page\upperrightlowerimage.png')}}">

                 </div>
               </aside>
           </article>
       </main>
<!--   End  the section lower to slider -->

<!--Start Featured Items    -->
       <main class="container">
         <!-- title -->
           <article class="row">
             <div class="col-4 col-md-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
             <h4 class="col-5 col-md-3  font-weight-bold">Featured Items</h4>
             <div class="col-3 col-md-4 mt-3" style="height: 4px;border:1px darkgray solid"></div>
         </article>
           <!-- All Men Women kids-->
           <article class="row text-center">
               <div class="mt-4 col-md-6 col-9 mx-auto">
                   <a class="col-3  featuredcat" href="#">All</a>
                   <a class="col-3  featuredcat" href="#">Men</a>
                   <a class="col-3  featuredcat" href="{{route('searchcategorywelcomert',"Women")}}">Women</a>
                   <a class="col-3  featuredcat" href="{{route('searchcategorywelcomert',"Kids")}}">Kids</a>

               </div>
           </article>
       </main>
           <!--Featured products -->
           @if(!isset($records))
               <?php $records=App\Models\Product::all(); ?>
               @endif
           <!-- featured box -->
           <main class="container" id="featuredbox">
               <article class="row ">
               @foreach($records as $record)
                   <div class="col-6 col-md-4 col-lg-3">
                       <div class="pt-4">
                   <img src="{{asset('images\products\\'.$record['image'])}}" style="width:100%;height:380px">
                    <h3>Suspendisse et.</h3>
                    <img src="{{asset('images\starsimage.png')}}" style="width:90%">
                     <article>
                         <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%;">
                             <i class="fas fa-heart"></i></button>
                         <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%">
                             <a href="#" class="text-gray shoppingcarftbutton" data-id="{{$record['id']}}"><i class="fas fa-shopping-cart mx-0"></i></a></button>

                         <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%">
                             <a href="#" class="text-gray "><i class="fas fa-share-alt"></i></a></button>
                         </article>
                   </div>
                   </div>
               @endforeach
               </article>
           </main>


       <!--End Featured Items    -->
<!--middle image -->
       <main class="container-fluid p-0">
           <img class="col-12 p-0 mt-5" src="{{asset('images\page\middlewelcomeimage.png')}}">
       </main>
<!-- trending items -->
       <!-- title -->
       <main class="container">
       <article class="row mt-5">
           <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
           <h4 class="col-2 font-weight-bold">Trend Item</h4>
           <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
       </article>
       </main>
       <!-- Trend item box -->
       <?php $records=App\Models\Product::where('sale','Trend')->get() ?>
       <main class="container" >
           <article class="row ">
               @foreach($records as $record)
                   <div class="col-6 col-md-4 col-lg-3">
                       <div class="pt-4">
                           <img src="{{asset('images\products\\'.$record['image'])}}" style="width:100%;height: 380px;">
                           <h3>Suspendisse et.</h3>
                           <img src="{{asset('images\starsimage.png')}}" style="width:90%">
                           <article>
                               <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%;">
                                   <i class="fas fa-heart"></i></button>
                               <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%">
                                   <a href="#" class="text-gray shoppingcarftbutton" data-id="{{$record['id']}}"><i class="fas fa-shopping-cart mx-0"></i></a></button>

                               <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%">
                                   <a href="#" class="text-gray "><i class="fas fa-share-alt"></i></a></button>
                           </article>
                       </div>
                   </div>
               @endforeach
           </article>
           <div class="text-center mx-auto w-25 mt-5">
           <button style="padding:5px 15px;">LOAD MORE</button>
           </div>
       </main>
<!--End of trend item box -->
<!-- Up of the blogs image -->
       <main class="container-fluid p-0">
           <img class="col-12 p-0 mt-5" src="{{asset('images\page\upblogsimage.png')}}">
       </main>
<!-- start blog-->
    <!--title -->
       <main class="container">
           <article class="row mt-5">
               <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
               <h4 class="col-2 font-weight-bold">Latest Blogs</h4>
               <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
           </article>
       </main>
       <!--blog section -->
       <main class="container">
           <article class="row mt-5 px-5">
               <!-- first box -->
               <div class="col-12 col-md-4 ">
                   <div>
                       <img src="{{asset('images\page\blogimage1.png')}}" style="width:90%">
                       <h4 class="mt-2">Some Headline Here</h4>
                       <p style="font-size: 12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                       <button style="padding:5px 15px">READ MORE</button>
                   </div>
               </div>
               <!-- second box -->
               <div class="col-12 col-md-4 ">
                   <div>
                       <img src="{{asset('images\page\blogimage2.png')}}" style="width:90%">
                       <h4 class="mt-2">Some Headline Here</h4>
                       <p style="font-size: 12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                       <button style="padding:5px 15px">READ MORE</button>
                   </div>
               </div>
               <!-- third box -->
               <div class="col-12 col-md-4 ">
                   <div>
                       <img src="{{asset('images\page\blogimage3.png')}}" style="width:90%">
                       <h4 class="mt-2">Some Headline Here</h4>
                       <p style="font-size: 12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                       <button style="padding:5px 15px">READ MORE</button>
                   </div>
               </div>
           </article>
       </main>
       <!-- shop by brand section-->
         <!--title --> <!--title -->
       <main class="container ">
           <article class="row mt-5">
               <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
               <h4 class="col-2 font-weight-bold">Shop By Brand</h4>
               <div class="col-5 mt-3" style="height: 4px;border:1px darkgray solid"></div>
           </article>
       </main>
        <!-- body of shop brand section -->
       <main class="container mt-5 py-5 mb-5">
           <article class="row">
               <div class="col-6 col-md-3">
                   <img src="{{asset('images\page\brandimage1.png')}}">
               </div>
               <div class="col-6 col-md-3">
                   <img src="{{asset('images\page\brandimage1.png')}}">
               </div>
               <div class="col-6 col-md-3">
                   <img src="{{asset('images\page\brandimage2.png')}}">
               </div>
               <div class="col-6 col-md-3">
                   <img src="{{asset('images\page\brandimage1.png')}}">
               </div>

           </article>
       </main>
       @endsection
       <script src="{{asset('js\jquery-3.5.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".featuredcat").css("color","darkgray");
        //ajax function that searches featured category
        $(".featuredcat").on("click",function (e) {
            e.preventDefault();
            $(".featuredcat").css("color","darkgray");
            $(this).css("color","#e680e0");
          $.ajax({
               type :"get",
               url :"{{route('searchcategorywelcomert')}}",
              datatype :"html",
              data :{cat:$(this).text()},
              success :function (data) {
                   var htmlview=data.html;
                   var obj=$(htmlview).find("#featuredbox");
                   $('#featuredbox').html(obj);


              },
              error :function () {
                  alert("error")
              }
           })


        })
    })
</script>
