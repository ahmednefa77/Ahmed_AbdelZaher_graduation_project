
@extends('auth.Admin.Adminmaster')

@section('content')
    @if(session('role')=="Admin")
    <h1 class="text-center p-2 col-12 border-bottom mx-auto">Update Existing Product</h1>
    @else
        <h1 class="text-center p-2 col-10 border-bottom mx-auto">Displaying Existing Product</h1>

    @endif
    @if((session('success')))
        <div class="alert alert-success text-center col-6 mx-auto" role="alert">
            {{session('success')}}
        </div>
    @endif
    <main class="container">
        <div class="text-center   my-auto " >
            <img src="{{asset('images\products\\'.$record->image)}}" id="productimage">
        </div>


    <form method="POST" class="col-8  p-3 mx-auto" action="{{route('updateproductrt',$record->id)}}" enctype="multipart/form-data">
    @csrf
    <!-- Validation Type -->
        <input type="text" value="updateproduct" name="validationtype" hidden>

        <!-- id Line-->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  readonly name="id" value="{{$record->id}}">
            </div>
        </div>
            <!-- Name Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="Name" name="name" value="{{$record->name}}">
            </div>


            @error('name')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- Price Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="Price" name="price" value="{{$record->price}}">
            </div>
            @error('price')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- Sale Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Sale</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="Sale" name="sale" value="{{$record->sale}}">
            </div>
            @error('sale')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- Category Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
            <?php $cats=App\Models\Category::all()?>
            {{--  <input type="text" class="form-control"  placeholder="Category" name="category" value="{{old('category')}}"> --}}
                <select class="form-control" name="category_id" >
                    <option value="">Category</option>
                    @foreach($cats as $cat)
                        @if($cat['id']==$record['category_id'])
                        <option value="{{$cat['id']}}" selected>{{$cat['name']}}</option>
                        @else
                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>

                        @endif
                    @endforeach
                </select>
            </div>
            @error('category_id')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- image Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
                <input type="file" class="form-control p-1"  id="productimagebutton" name="image">
            </div>
            @error('image')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- Details Line -->
        <div class="form-group row ">
            <label  class="col-sm-2 col-form-label">Details</label>
            <div class="col-sm-10">
                <textarea  class="form-control"  name="details" >{{$record->details}}</textarea>
            </div>
            @error('details')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        @if(session('role')=="Admin")
        <button type="submit" class="btn btn-primary">Save</button>
        @else
            <a href="{{route('showallproductsrt')}}" class="btn btn-success">Ok</a>
        @endif

    </form>





    </main>
@endsection
@section('myjquery')
    <script>
        $(document).ready(function() {
            $("#productimagebutton").on("change",function () {
                var myfile=$(this).val().split('\\').pop();
               // alert(myfile);
                var tmppath = URL.createObjectURL(event.target.files[0]);
                alert(tmppath);
                $("#productimage").attr('src',tmppath);
            })
        })
    </script>
    @endsection
