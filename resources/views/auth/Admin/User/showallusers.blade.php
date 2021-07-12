@extends('auth.Admin.Adminmaster')

@section('content')

   {{-- /////////////////////Customization Form  --}}
   <main class="container-fluid" style="overflow-x:scroll">
    <form id="customizeform" style="display: none;background-color: lightgrey" class=" co-12" >
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton" style="color:green" type="checkbox" checked data-id="id">
            <label class="form-check-label" >
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
                Email
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="role" >
            <label class="form-check-label" for="defaultCheck2">
                Role
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="blocked" >
            <label class="form-check-label" for="defaultCheck2">
                Status
            </label>
        </div>
        <div class="form-check d-inline-flex ml-3">
            <input class="form-check-input customizebutton " type="checkbox" checked data-id="control" >
            <label class="form-check-label" for="defaultCheck2">
                Control
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
           {{--Email Field--}}
           <div class="form-check d-inline-flex ml-3">
           <div class="my-auto">
               <input class="form-check-input customizebutton" type="checkbox" checked id="emailcheckbox">
               <label class="form-check-label mr-3" for="defaultCheck1">
                  Email
               </label>
           </div>
               <input type="text" class="form-control" id="emailtext" required placeholder="Email" >
           </div>

           {{--Role Field--}}
           <div class="form-check d-inline-flex ml-3">
               <div class="my-auto">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="rolecheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Role
                   </label>
               </div>
               <select type="text" class="form-control" id="roletext">
                   <option value="">Role</option>
                   <option value="User">User</option>
                   <option value="Moderator">Moderator</option>
                   <option value="Admin">Admin</option>
               </select>
           </div>
           {{--Status Field--}}
           <div class="form-check d-inline-flex ml-3">
               <div class="my-auto">
                   <input class="form-check-input customizebutton" type="checkbox" checked id="statuscheckbox">
                   <label class="form-check-label mr-3" for="defaultCheck1">
                       Status
                   </label>
               </div>
               <select type="text" class="form-control" id="statustext">
                   <option value="">All users</option>
                   <option value="0">Allowed</option>
                   <option value="1">Blocked</option>
               </select>
           </div>


           {{--- deep search button --}}
           <div class="form-check d-inline-flex ml-5">
           <button class="btn btn-info ml-5 " id="deepsearchbutton" >Search</button>
           </div>
       </form>


    <article id="tablearticle">
   {{-- ////////////////////////////End of deepsearch Form  ////////////////////////--}}
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Show  Members</h1>
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
        <!-- Table Header-->
        <thead>
        <tr>
            <th scope="col" class="id field" data-id="id">#</th>
            <th scope="col" class="name field" data-id="name">Name</th>
            <th scope="col" class="email field" data-id="email">email</th>
            <th scope="col" class="role field" data-id="role">Role</th>
            <th scope="col" class="blocked field" data-id="blocked">Status</th>
            <th scope="col" class="control " data-id="control">Control</th>


        </tr>
        </thead>
        <!-- Table Body-->
        <tbody>
        @foreach($records as $record)
        <tr>

            <td class="id">{{$record['id']}}</td>
            <td class="name">{{$record['name']}}</td>
            <td class="email">{{$record['email']}}</td>
            <td class="role">{{$record['role']}}</td>
            <td class="blocked">{{$record['blocked']==0 ? "User Allowed":"User Blocked"}}</td>


            {{--if member is admin then show Delete and Edit button--}}
            @if(session('role')=="Admin")
              <td class="d-flex control">
                  <a href="{{route('showupdateuserformrt',$record['id'])}}" class="btn btn-sm btn-success col-4 control">Edit</a>
                  <form action="{{route('deleteuserrt',$record['id'])}}" method="post" class="col-4 control ">
                      @csrf
                      <input type="submit" onclick="return confirm('Are You Sure You Will Delete\n' +'{{$record['name']}}');" class=" btn btn-danger ms-2 btn-sm" value="Delete">
                  </form>
              </td>
            @endif
            @if(session('role')=="Moderator")
                <td >
                    <a href="{{route('showupdateuserformrt',$record['id'])}}" class="btn btn-sm btn-success ">show all data</a>
                </td>
            @endif

        </tr>
        @endforeach


        </tbody>
        </table>
    </article>

   </main>
@endsection
<!-- Jquery Code -->
@section('myjquery')
    <script>
        $(document).ready(function(){
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
                var searchname,searchemail,searchrole,searchstatus;
               searchname= ($('#namecheckbox').is(":checked") ) ? $("#nametext").val():"";
               searchemail=($('#emailcheckbox').is(":checked") ) ? $("#emailtext").val():"";
               searchrole=($('#rolecheckbox').is(":checked")) ? $("#roletext").val():"";
                searchstatus=($('#statuscheckbox').is(":checked")) ? $("#statustext").val():"";
       alert(searchname+"   "+searchemail+"    "+searchrole+"    "+searchstatus);
                //if(myquery !='') myquery="where "+myquery;
                $.ajax({
                    type:"get",
                    url :"{{route("tabledeepsearchuserrt")}}",
                    datatype : "html",
                    data :{searchname:searchname,
                        searchemail:searchemail,
                        searchrole: searchrole,
                        searchstatus:searchstatus},
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
                    url : "{{route('orderusertablebyrt')}}",
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
