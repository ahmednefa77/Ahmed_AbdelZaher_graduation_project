
@extends('auth.Admin.Adminmaster')

@section('content')

    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Add New Member</h1>
    @if((session('success')))
        <div class="alert alert-success text-center col-6 mx-auto" role="alert">
                 {{session('success')}}
        </div>
        @endif
    <main class="container">
        <div class="text-center   my-auto " >
            <img src="{{asset('images\users\default.png')}}" id="productimage">
        </div>

        <form method="POST" class="col-8 mx-auto p-3" action="{{route('storeuserrt')}}" enctype="multipart/form-data">
            <h3 class="col-6 border-bottom border-1 p-3 mr-5" >Account Information</h3>

        @csrf
        <!-- Validation Type -->
            <input type="text" value="newuserprofile" name="validationtype" hidden>

            <!-- Name Line -->
        <div class="form-group row ">
            <label  class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  placeholder="Name" name="name" value="{{old('name')}}">
            </div>
            @error('name')
            <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
            @enderror
        </div>
        <!-- email Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control"  placeholder="Email" name="email" value="{{old('email')}}">
                </div>
                @error('email')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Password Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  placeholder="Password" name="password" >
                </div>
                @error('password')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Password Retype Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label ">Confirm Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  placeholder="Retype Password" name="confirmpassword" >
                </div>
                @error('retypepassword')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>


            <!-- Role Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    {{--<?php $cats=App\Models\Category::all()?>--}}
                    <select class="form-control" name="role">
                        <option value="">role</option>

                            <option value="User">User</option>
                            {{--If member is administrator Add Admin and Moderator role--}}
                            @if(Auth::user()->role=="Admin")
                            <option value="Moderator">Moderator</option>
                            <option value="Admin">Admin</option>

                        @endif

                    </select>
                </div>
                @error('role')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Blocked Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Member Status</label>
                <div class="col-sm-9">
                    {{--<?php $cats=App\Models\Category::all()?>--}}
                    <select class="form-control" name="blocked">
                        <option value="0" selected>Member Is Allowed</option>
                        <option value="1">Member Is Blocked</option>
                    </select>
                </div>
                @error('blocked')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <hr>
            <!-- Profile Data -->
            <h3 class="col-6 border-bottom border-1 p-3 mr-5" >Profile Information</h3>

            <!-- image Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Image</label>
                <div class="">
                    <input type="file" class="form-control p-1"  id="productimagebutton" name="image">
                </div>
                @error('image')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Mobile Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Mobile</label>
                <div class="">
                    <input type="text" class="form-control"  placeholder="Mobile" name="mobile" value="{{old('mobile')}}">
                </div>
                @error('mobile')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Address Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Address</label>
                <div class="col-10">
                    <input type="text" class="form-control"  placeholder="Address" name="address" value="{{old('address')}}">
                </div>
                @error('address')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Birthdate Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Birthdate</label>
                <div class="">
                    <input type="date" class="form-control"  placeholder="Birthdate" name="birthdate" value="{{old('birthdate')}}">
                </div>
                @error('birthdate')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Gender Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Gender</label>
                <div class="">
                    <select class="form-control" name="gender">
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>

                    </select>
                </div>
                @error('gender')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- About me Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">About me</label>
                <div class="col-sm-10">
                    <textarea  class="form-control"  name="aboutme" >{{old('aboutme')}}</textarea>
                </div>
                @error('aboutme')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>

                <button type="submit" class="btn btn-primary">Save</button>


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

                $("#productimage").attr('src',tmppath);
            })
        })
    </script>
@endsection
