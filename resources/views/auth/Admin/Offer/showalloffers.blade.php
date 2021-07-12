@extends('auth.Admin.Adminmaster')

@section('content')
   {{-- /////////////////////Customization Form  --}}
   <main class="container">


    <article id="tablearticle">
   {{-- ////////////////////////////End of deepsearch Form  ////////////////////////--}}
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Show Offers</h1>
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
        {{--Displaying error message --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center col-6 mx-auto">
                {{$errors->first()}}
            </div>
        @endif
        {{--      --}}
        {{--table style --}}
        <style>
            table th {min-width: 90px;cursor: pointer}
            table {font-size: 10px}
            table tr td input{border-style: none;background-color: transparent;color:white}
        </style>
        {{--error displayed when there is validation error during update --}}
        @if (session('updateerror'))
            <div class="alert alert-danger text-center offset-2 col-6">{{session('updateerror')}}</div>

        @endif
        {{-- table layout --}}
    <table class="table  table-dark table-hover table-responsive-sm col-12" id="producttable">
        <thead>
        <tr>
            <th scope="col" class="id field" data-id="id">#</th>
            <th scope="col" >Product</th>
            <th scope="col" >Quantity</th>
            <th scope="col" >Price Before</th>
            <th scope="col" >Price After</th>

            {{-- if member is Admin add control field--}}
            @if(session('role')=="Admin")
            <th scope="col" class="control ">Control Update</th>
            <th scope="col" class="control ">Control Delete</th>

            @endif

        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
    <tr>

                <form action="{{route('updateofferrt',$record['id'])}}" method="post" enctype="multipart/form-data" id="updateform" >
                    @csrf
                    <!-- Validation Type -->
                        <input type="text" value="updateoffer" name="validationtype" hidden>

                        <td class="id">{{$record['id']}}</td>

            <td >{{$record->product->name}}</td>
            <td><input type="text" name="Quantity" value="{{$record['Quantity']}}"></td>
            <td><input type="text" name="price_before" value="{{$record['price_before']}}"></td>
            <td><input type="text" name="price_after" value="{{$record['price_after']}}"></td>

            {{--if member is admin then add Delete and Update buttons --}}
            @if(session('role')=="Admin")
              <td class="d-flex control">

                      <input type="submit" id="updateofferdb" class="btn btn-success" value="Update">
              </td>
            </form>
            <td>
                  <form action="{{route('deleteofferrt',$record['id'])}}" method="post" class="col-4 control ">
                      @csrf
                      <input type="submit" onclick="return confirm('Are You Sure You Will Delete Offer \n' +'{{$record->product->name}}');" class=" btn btn-danger" value="Delete">
                  </form>
              </td>
            @endif
            {{-- if member is Moderator--}}
            @if(session('role')=="Moderator")
            </form>
            @endif

        </tr>
        @endforeach


        </tbody>
        </table>

        <input type="button" class="btn btn-info" value="Add New Offer" id="Toggleaddnewbutton">

       {{-- ////Add new offer form --}}
        <section id="Addnewsection" style="display: none" class="col-6 mx-auto">
        <h1 class="text-center p-2  border-bottom mx-auto">Add New Offer</h1>
        <form method="post" action="{{route('storeofferrt')}}" class=" mx-auto p-3" id="Addnewform" >
        @csrf
        <!-- Validation Type -->
            <input type="text" value="newoffer" name="validationtype" hidden>

            <!-- Produc Name select Box -->
            <div class="form-group row ">
                <label  class="col-sm-4 col-form-label">Product</label>
                <div class="col-sm-8">
                <?php $cats=App\Models\Product::all()?>
                    <select class="form-control" name="product_name">
                        <option value="">Product</option>
                        @foreach($cats as $cat)
                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('product_name')
                <small class="text-danger text-center offset-4 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Quantity  Line -->
            <div class="form-group row ">
                <label  class="col-sm-4 col-form-label">Quantity</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  placeholder="Quantity" name="Quantity" value="{{old('Quantity')}}">
                </div>

                @error('Quantity')
                <small class="text-danger text-center offset-4 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- price_before  Line -->
            <div class="form-group row ">
                <label  class="col-sm-4 col-form-label">Price Before Offer</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  placeholder="Price Before Offer" name="price_before" value="{{old('price_before')}}">
                </div>

                @error('price_before')
                <small class="text-danger text-center offset-4 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- price_after  Line -->
            <div class="form-group row ">
                <label  class="col-sm-4 col-form-label">Price After Offer</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  placeholder="Price After Offer" name="price_after" value="{{old('price_after')}}">
                </div>

                @error('Quantity')
                <small class="text-danger text-center offset-4 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Submit button -->
            <div class="col-sm-2">
                <input type="submit" class="form-control p-1 btn btn-info"  value="save">
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
            }, 5000)
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
