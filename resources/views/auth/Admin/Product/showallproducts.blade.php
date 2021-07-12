@extends('auth.Admin.Adminmaster')

@section('content')
   {{-- /////////////////////Customization Form  --}}
   <main class="container-fluid" style="overflow-x:scroll">
    <form id="customizeform" style="display: none;background-color: lightgrey" class=" co-12" >
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton" type="checkbox" checked data-id="id">
            <label class="form-check-label" for="defaultCheck1">
                id
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="name" >
            <label class="form-check-label" for="defaultCheck2">
                Name
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="price" >
            <label class="form-check-label" for="defaultCheck2">
                Price
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="sale" >
            <label class="form-check-label" for="defaultCheck2">
                Sale
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="category" >
            <label class="form-check-label" for="defaultCheck2">
                Category
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="image" >
            <label class="form-check-label" for="defaultCheck2">
                Image
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked  data-id="details" >
            <label class="form-check-label" for="defaultCheck2">
                Details
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="control" >
            <label class="form-check-label" for="defaultCheck2">
                Controll
            </label>
        </div>
    </form>
       {{--start of deep search Form-------}}

       <form id="deepsearchform" style="display: none;background-color: lightgrey" class="co-12" >
           {{--Name Field--}}
           <div class="form-check d-inline-flex ml-3">
               <div class="my-auto">
               <input class="form-check-input customizebutton" type="checkbox" required checked id="namecheckbox"">
               <label class="form-check-label mr-3" for="defaultCheck1">
                  Name
               </label>
               </div>
               <input type="text" class="form-control" id="nametext" required placeholder="Name" >
               </div>
           {{--Category Field--}}
           <div class="form-check d-inline-flex ml-3">
           <div class="my-auto">
               <input class="form-check-input customizebutton" type="checkbox" checked id="categorycheckbox">
               <label class="form-check-label mr-3" for="defaultCheck1">
                  Category
               </label>
           </div>
           <select class="form-control" name="selecttext" id="categorytext">
               <option class="form-control"value=""></option>
               <?php $cats=App\Models\Category::all();?>
               @foreach ($cats as $cat)
                   <option class="form-control" value="{{$cat['id']}}">{{$cat['name']}}</option>
               @endforeach
           </select>
           </div>

           {{--Price Field--}}
           <div class="form-check d-inline-flex ml-3 col-6 col-md-4 ">
               <div class="my-auto" >
                   <input class="form-check-input customizebutton" type="checkbox" checked id="pricecheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Price
                   </label>
               </div>
                <div class="d-flex my-auto">
                    <label class="mr-3 d-inline-flex pt-2" >
                        From
                    </label>
                    <input type="text" class="form-control d-inline-flex col-5"  placeholder="From" id="pricefromtext">
                    <label class="mr-3 d-inline-flex pt-2" >
                        To
                    </label>
                    <input type="text" class="form-control d-inline-flex col-5"  placeholder="To" id="pricetotext">

                </div>

           </div>
           <br>
           {{--- deep search button --}}
           <button class="btn btn-info ml-3 mb-1" id="deepsearchbutton" >Search</button>
       </form>


    <article id="tablearticle">
   {{-- ////////////////////////////End of deepsearch Form  ////////////////////////--}}
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Show  Products</h1>
    @if(session('deletesuccess'))
        <div class="alert alert-success text-center col-6 mx-auto" role="alert">
            {{session('deletesuccess')}}
        </div>
    @endif
        <style>
            table th {min-width: 90px;cursor: pointer}
            table .category{min-width: 110px}
            table {font-size: 10px}
        </style>
    <table class="table  table-dark table-hover table-responsive-sm col-12" id="producttable">
        <thead>
        <tr>
            <th scope="col" class="id field" data-id="id">#</th>
            <th scope="col" class="name field" data-id="name">Name</th>
            <th scope="col" class="price field" data-id="price">Price</th>
            <th scope="col" class="sale field" data-id="sale">Sale</th>
            <th scope="col" class="category field" data-id="category_id">Category</th>
            <th scope="col" class="image ">Image</th>
            <th scope="col" class="details field" data-id="details" >Details</th>
            <th scope="col" class="control ">Control</th>


        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
        <tr>

            <td class="id">{{$record['id']}}</td>
            <td class="name">{{$record['name']}}</td>
            <td class="price">{{$record['price']}}</td>
            <td class="sale">{{$record['sale']}}</td>
            <td class="category">{{$record['category_name']}}</td>

            <td class="image"><img style="height:40px;width:30px;" src="{{asset('images\products\\'.$record['image'])}}"></td>
            <td class="details" >{{$record['details']}}</td>

            {{--if member is admin then show Delete and Edit button--}}
            @if(session('role')=="Admin")
              <td class="d-flex control">
                  <a href="{{route('showupdateproductformrt',$record['id'])}}" class="btn btn-sm btn-success col-4 control">Edit</a>
                  <form action="{{route('deleteproductrt',$record['id'])}}" method="post" class="col-4 control ">
                      @csrf
                      <input type="submit" onclick="return confirm('Are You Sure You Will Delete\n' +'{{$record['name']}}');" class=" btn btn-danger ms-2 btn-sm" value="Delete">
                  </form>
              </td>
            @endif
            @if(session('role')=="Moderator")
                <td >
                    <a href="{{route('showupdateproductformrt',$record['id'])}}" class="btn btn-sm btn-success ">show all data</a>
                </td>
            @endif

        </tr>
        @endforeach


        </tbody>
        </table>
    </article>

   </main>
@endsection
@section('myjquery')
    <script>
        $(document).ready(function(){
            //hide alert element after certain time ---Hide flash message After certain time 5 seconds
            setTimeout(function() {
                $('.alert').slideUp();
            }, 5000);
            ////function to hide or show table fields according to check button status
            function checkcustomizationstatus(){
            $(".customizebutton").each(function (key,index) {
                     var myname=$(this).attr("data-id");
                     if($(this).is(":checked"))
                         $("."+myname).show();
                     else $("."+myname).css("display","none");

                 });}
            ///////************Start Customization *********************///////////////
            //show customize button in bar when loading this page as it is hidden in Adminmaster blade
            $("#customizeshowformbutton").css("display","block");
          ///toggle customize form when clicking customize button
           $("#customizeshowformbutton").on("click",function (e) {


                $("#customizeform").slideToggle();

            });
           //Display hide the corresponding field when check or uncheck checkbox
            $(".customizebutton").on("change",function () {
                /*var myname=$(this).attr("data-id");
                if($(this).is(":checked"))
                $("."+myname).show();
                else                 $("."+myname).css("display","none");*/

                checkcustomizationstatus()

            });
            ///////************End Customization *********************///////////////
            ////////////////////////////////////////////
            ///////************Start deepsearch *********************///////////////
            //show deepsearch button in bar when loading this page as it is hidden in Adminmaster blade
            $("#deepsearchshowformbutton").css("display","block");
            ///toggle deepsearch form when clicking deepsearch button
            $("#deepsearchshowformbutton").on("click",function (e) {


                $("#deepsearchform").slideToggle();

            });
            ///////************End deepsearch *********************///////////////
           ///////////////////////////////////////////////////////////////////
            ///////************Start deepsearch ajax from Product database table *********************///////////////
            $("#deepsearchbutton").on("click",function (e) {
                var myquery="";
                e.preventDefault();
                //store the search fields
                var searchname,searchcatid,searchpricefrom,searchpriceto;
               searchname= ($('#namecheckbox').is(":checked") ) ? $("#nametext").val():"";
               searchcatid=($('#categorycheckbox').is(":checked") ) ? $("#categorytext").val():"";
               searchpricefrom=($('#pricecheckbox').is(":checked")) ? $("#pricefromtext").val():"";
                searchpriceto=($('#pricecheckbox').is(":checked")) ? $("#pricetotext").val():"";

                //if(myquery !='') myquery="where "+myquery;
                $.ajax({
                    type:"get",
                    url :"{{route("tabledeepsearchrt")}}",
                    datatype : "html",
                    data :{searchname:searchname,
                        searchcatid:searchcatid,
                        searchpricefrom: searchpricefrom,
                        searchpriceto:searchpriceto},
                    success : function (data) {
                        alert("Success");
                        alert(data);
                        var htmlview=data.html;
                       var obj=$(htmlview).find('#tablearticle');
                        $('#tablearticle').html(obj);
                        checkcustomizationstatus();

                    },
                    error : function () {
                        alert("Error wa lellah el7md");

                    }
                })
            })
            ///////************End deepsearch ajax from Product database table *********************///////////////

            /////////start of order by field///////////

            $("body").delegate(".field","click",function () {

                  var orderbyfield=$(this).attr("data-id");



                $.ajax({
                    url : "{{route('ordertablebyrt')}}",
                    type : "get",
                    datatype :"html",
                    data :{orderbyfield:orderbyfield},
                    success : function(data){alert("success")
                        var htmlview=data.html;
                        var obj=$(htmlview).find('#tablearticle');
                        $('#tablearticle').html(obj);
                        checkcustomizationstatus();



                    },
                    error :function () {
                        alert ("error in ordering");

                    },


                }).done(function (obj) {

                   obj=$(".field[data-id = '"+orderbyfield+"']");
                    $(".field span").remove();
                    obj.append($("<span><i class='fas fa-sort ml-1 '></i></span>"));

                })




            })
            /////////end of order by field///////////

        })


    </script>
@endsection
