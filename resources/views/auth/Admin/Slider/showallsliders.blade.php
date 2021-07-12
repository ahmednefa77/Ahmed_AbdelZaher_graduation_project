@extends('auth.Admin.Adminmaster')

@section('content')
   {{-- /////////////////////Customization Form  --}}
   <main class="container" >


    <article id="tablearticle">
   {{-- ////////////////////////////End of deepsearch Form  ////////////////////////--}}
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Show  Sliders</h1>
     {{--- Alert displayed when delete success--}}
      @if(session('deletesuccess'))
        <div class="alert alert-success text-center col-6 mx-auto" role="alert">
            {{session('deletesuccess')}}
        </div>
    @endif
        {{--alert displayed when adding new item --}}
        @if((session('success')))
            <div class="alert alert-success text-center col-6 mx-auto" role="alert">
                {{session('success')}}
            </div>
        @endif
        {{--- Alert displayed when delete success--}}
        @if(session('successupdate'))
            <div class="alert alert-success text-center col-6 mx-auto" role="alert">
                {{session('successupdate')}}
            </div>
        @endif
        {{--table style --}}
        <style>
            table th {min-width: 90px;cursor: pointer}
            table {font-size: 10px}
        </style>
        {{--error displayed when there is validation error during update --}}
        {{--error displayed when there is validation error during update --}}
        @if (session('updateerror'))
            <div class="alert alert-danger text-center offset-2 col-6">{{session('updateerror')}}</div>

        @endif
        {{-- table layout --}}
        {{-- table layout --}}
    <table class="table  table-dark table-hover table-responsive-sm col-12" id="producttable">
        <thead>
        <tr>
            <th scope="col" class="id field" data-id="id">#</th>
                 <th scope="col" class="image ">Image</th>
           {{-- if member is Admin add control field--}}
            @if(session('role')=="Admin")
            <th scope="col" class="control ">Control</th>
             @endif

        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
        <tr>

            <td class="id">{{$record['id']}}</td>

            <td class="image"><img style="height:40px;width:30px;" src="{{asset('images\sliders\\'.$record['image'])}}" name='tableimage'></td>

            {{--if member is admin then add Delete and Update buttons --}}
            @if(session('role')=="Admin")
              <td class="d-flex control">
                  <form action="{{route('updatesliderrt',$record['id'])}}" method="post" enctype="multipart/form-data" id="updateform" >
                      @csrf
                      <input type="file"  class=" btn btn-success ms-2 btn-sm" id="imageid" name="imageupdate" >
                      <input type="submit" id="updatesliderdb" class="btn btn-success" value="Update">
                  </form>
                  <form action="{{route('deletesliderrt',$record['id'])}}" method="post" class="col-4 control ">
                      @csrf
                      <input type="submit" onclick="return confirm('Are You Sure You Will Delete Image \n' +'{{$record['id']}}');" class=" btn btn-danger" value="Delete">
                  </form>
              </td>
            @endif
            {{-- if member is Moderator
            @if(session('role')=="Moderator")
                <td >
                    <a href="{{route('showupdateproductformrt',$record['id'])}}" class="btn btn-sm btn-success ">show all data</a>
                </td>
            @endif
--}}
        </tr>
        @endforeach


        </tbody>
        </table>
        <input type="button" class="btn btn-info" value="Add New Slider" id="Toggleaddnewbutton">

       {{-- ////Add new slider form --}}
        <section id="Addnewsection" style="display: none">
        <h1 class="text-center p-2 col-10 border-bottom mx-auto">Add New Slider</h1>
        <form method="post" action="{{route('storesliderrt')}}" class="col-8 mx-auto p-3" id="Addnewform" enctype="multipart/form-data">
        @csrf

        <div class="text-center   my-auto " >
            <img src="{{asset('images\products\default.png')}}" id="productimage">
        </div>
    <div class="form-group row ">
        <label  class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-6">
            <input type="file" class="form-control p-1"  id="productimagebutton" name="image">
        </div>
        <div class="col-sm-2">
            <input type="submit" class="form-control p-1 btn btn-info"  value="save">
        </div>
        @if (session('storeerror')=="true")
        @error('image')
        <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
        @enderror
        @endif
    </div>
</form>
        </section>
    </article>

   </main>
@endsection
@section('myjquery')
    <script>
        $(document).ready(function() {
            //hide alert element after certain time ---Hide flash message After certain time 5 seconds
            setTimeout(function() {
                $('.alert').slideUp();
            }, 5000);
            //display image when you choose input file
            $("#productimagebutton").on("change",function () {
                var myfile=$(this).val().split('\\').pop();
                // alert(myfile);
                var tmppath = URL.createObjectURL(event.target.files[0]);
                alert(tmppath);
                $("#productimage").attr('src',tmppath);
            })
            //Toggle Add new button
            $("#Toggleaddnewbutton").on("click",function () {
                $("#Addnewsection").slideToggle();

            })
        })
    </script>

@endsection
