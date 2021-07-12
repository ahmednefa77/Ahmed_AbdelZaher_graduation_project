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
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="email" >
            <label class="form-check-label" for="defaultCheck2">
                email
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="mobile" >
            <label class="form-check-label" for="defaultCheck2">
                Mobile
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="address" >
            <label class="form-check-label" for="defaultCheck2">
                Address
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="birthdate" >
            <label class="form-check-label" for="defaultCheck2">
                Birthdate
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked  data-id="gender" >
            <label class="form-check-label" for="defaultCheck2">
                Gender
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked  data-id="aboutme" >
            <label class="form-check-label" for="defaultCheck2">
                About Member
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="image" >
            <label class="form-check-label" for="defaultCheck2">
                Image
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

       <form id="deepsearchform" style="display: none;background-color: lightgrey" class="container co-12" >
           <article class="row col-11">
           {{--Name Field--}}
           <div class="form-check d-inline-flex col-md-3">
               <div class="my-auto col-md-5">
                   <input class="form-check-input customizebutton" type="checkbox" required checked id="namecheckbox"">
                   <label class=" col-md-12" for="defaultCheck1">
                       Name
                   </label>
               </div>
               <input type="text" class="form-control" id="nametext" required placeholder="any" >
           </div>
           {{--Email Field--}}
           <div class="form-check d-inline-flex col-md-3">
               <div class="my-auto col-md-5">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="emailcheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Email
                   </label>
               </div>
               <input type="text" class="form-control" id="emailtext" required placeholder="any" >
           </div>
           {{--Mobile  Field--}}
           <div class="form-check   col-md-3 d-none">
               <div class="my-auto">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="mobilecheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Mobile
                   </label>
               </div>
               <input type="text" class="form-control" id="mobiletext" required placeholder="any" >
           </div>
               <div class="form-check d-inline-flex col-md-3">
                   <button class="btn btn-info btn-sm " id="deepsearchbutton" >Search</button>
               </div>
           </article>
           <article class="row col-11 d-none">
           {{--Address Field--}}
           <div class="form-check d-inline-flex  col-md-3 ml-2 d-none">
               <div class="my-auto">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="addresscheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Address
                   </label>
               </div>
               <input type="text" class="form-control" id="addresstext" required placeholder="any" >
           </div>

           {{--Gender Field--}}
           <div class="form-check d-inline-flex col-md-3 d-none">
               <div class="my-auto">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="gendercheckbox">
                   <label class="form-check-label" for="defaultCheck1">
                       Gender
                   </label>
               </div>
               <select class="form-control mx-auto" id="gendertext" required placeholder="any" >
                   <option value="">any</option>
                   <option value="male">Male</option>
                   <option value="female">Female</option>
               </select>
           </div>

           {{--Age Field--}}
           <div class="form-check d-inline-flex  col-6 col-md-3 d-none ">
               <div class="my-auto" >
                   <input class="form-check-input customizebutton" type="checkbox" checked id="agecheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Age
                   </label>
               </div>
               <div class="d-flex my-auto">
                   <label class="mr-1 d-inline-flex pt-2" >
                       From
                   </label>
                   <input type="text" class="form-control d-inline-flex col-2 p-0"  placeholder="From" id="agefromtext">
                   <label class="mr-1 d-inline-flex pt-2" >
                       To
                   </label>
                   <input type="text" class="form-control d-inline-flex col-2 p-0"  placeholder="To" id="agetotext">
                   <label class="form-check-label my-auto ml-2" for="defaultCheck1">
                       years
                   </label>
               </div>
           </div>
               {{--- deep search button --}}

           </article>

       </form>


    <article id="tablearticle">
   {{-- ////////////////////////////End of deepsearch Form  ////////////////////////--}}
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Profiles</h1>
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

            <th scope="col" class="email field" data-id="email">Email</th>
            <th scope="col" class="mobile field" data-id="mobile">Mobile</th>
            <th scope="col" class="address field" data-id="address">Address</th>
            <th scope="col" class="birthdate field" data-id="birthdate">Birthdate</th>

            <th scope="col" class="gender field" data-id="gender" >Gender</th>
            <th scope="col" class="aboutme field" data-id="aboutme" >About Member</th>

            <th scope="col" class="image ">Image</th>
            <th scope="col" class="control ">Control</th>


        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
        <tr>

            <td class="id">{{$record['id']}}</td>
            <td class="name">{{$record['user_name']}}</td>
            <td class="email">{{$record['user_email']}}</td>
            <td class="mobile">{{$record['mobile']}}</td>
            <td class="address">{{$record['address']}}</td>
            <td class="birthdate">{{$record['birthdate']}}</td>
            <td class="gender" >{{$record['gender']}}</td>
            <td class="aboutme" >{{$record['aboutme']}}</td>

            <td class="image"><img style="height:40px;width:30px;" src="{{asset('images\users\\'.$record['image'])}}"></td>

            {{--if member is admin then show Delete and Edit button--}}
            @if(session('role')=="Admin")
              <td class="d-flex control">
                  <a href="{{route('showupdateuserformrt',$record['user_id'])}}" class="btn btn-sm btn-success col-4 control">Edit</a>
                  <form action="{{route('deleteuserrt',$record['user_id'])}}" method="post" class="col-4 control ">
                      @csrf
                      <input type="submit" onclick="return confirm('Are You Sure You Will Delete\n' +'{{$record['user_email']}}');" class=" btn btn-danger ms-2 btn-sm" value="Delete">
                  </form>
              </td>
            @endif
            @if(session('role')=="Moderator")
                <td >
                    <a href="{{route('showupdateuserformrt',$record['user_id'])}}" class="btn btn-sm btn-success ">show all data</a>
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
               searchemail=($('#emailcheckbox').is(":checked") ) ? $("#emailtext").val():"";
               searchmobile=($('#mobilecheckbox').is(":checked")) ? $("#mobiletext").val():"";
                searchaddress=($('#addresscheckbox').is(":checked")) ? $("#addresstext").val():"";
                searchgender=($('#genderscheckbox').is(":checked")) ? $("#gendertext").val():"";
                searchagefrom=($('#agescheckbox').is(":checked")) ? $("#agefromtext").val():"";
                searchageto=($('#agescheckbox').is(":checked")) ? $("#agetotext").val():"";

                //if(myquery !='') myquery="where "+myquery;
                $.ajax({
                    type:"get",
                    url :"{{route("tabledeepsearchprofilert")}}",
                    datatype : "html",
                    data :{searchname:searchname,
                        searchemail:searchemail,
                        searchmobile: searchmobile,
                        searchaddress:searchaddress,
                        searchgender:searchgender,
                    searchagefrom:searchagefrom,
                    searchageto:searchageto},
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
/*
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




            })*/
            /////////end of order by field///////////

        })


    </script>
@endsection
