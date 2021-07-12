
@extends('auth.Admin.Adminmaster')

@section('content')
     @if(session('role')=="Admin")
    <h1 class="text-center p-2 col-10 border-bottom mx-auto">Update Member</h1>
    @else
     <h1 class="text-center p-2 col-10 border-bottom mx-auto">Displaying Member</h1>
   @endif
         @if((session('success')))
        <div class="alert alert-success text-center col-6 mx-auto" role="alert">
            {{session('success')}}
        </div>
    @endif
    <main class="container">
        <div class="text-center   my-auto " >
            <?php $imagesrc="images\users\\".(isset($record->profile->image) ? $record->profile->image:'default.png');?>
            <img src="{{asset($imagesrc)}}" id="productimage">
        </div>

        <form method="POST" class="col-8 mx-auto p-3" action="{{route('updateuserrt',$record['id'])}}" enctype="multipart/form-data">
            <h3 class="col-6 border-bottom border-1 p-3 mr-5" >Account Information</h3>

        @csrf
        <!-- Validation Type -->
            <input type="text" value="updateuserprofile" name="validationtype" hidden>

            <!-- ID Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label" >ID</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" readonly placeholder="Name" name="name" value="{{$record['id']}}">
                </div>

            </div>
        <!-- Name Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  placeholder="Name" name="name" value="{{$record['name']}}">
                </div>
                @error('name')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- email Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control"  placeholder="Email" name="email" value="{{$record['email']}}">
                </div>
                @error('email')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>


            <!-- Role Line -->
            <div class="form-group row ">
                <label  class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    {{--<?php $cats=App\Models\Category::all()?>--}}
                    <select class="form-control" name="role">
                        <?php $allroles=array('User','Moderator','Admin') ?>
                    @foreach($allroles as $Role)

                        @if($record['role']==$Role)
                        <option value="{{$Role}}" selected>{{$Role}}</option>
                       @else
                       <option value="{{$Role}}" >{{$Role}}</option>
                       @endif
                    @endforeach

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
                        @if($record['blocked']==0)
                        <option value="0" selected>Member Is Allowed</option>
                        <option value="1">Member Is Blocked</option>
                         @else
                            <option value="0">Member Is Allowed</option>
                            <option value="1" selected >Member Is Blocked</option>

                        @endif
                    </select>
                </div>
                @error('blocked')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- change password -->
            <div>
                @if(session('role')=="Admin")
                <input type="checkbox" name="changepassword" id="changepasswordcheck">
                <label>Change Password</label>
                @endif
                <article id="PasswordBox" style="display: none">
                <!-- Password Line -->
                <div class="form-group row pl-5 d-block">
                    <label  class="col-sm-3 pl-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control "  placeholder="Password" name="password" value="{{$record['password']}}" >
                    </div>
                    @error('password')
                    <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                    @enderror
                </div>
                <!-- Password Retype Line -->
                <div class="form-group row pl-5 d-block">
                    <label  class="col-sm-5 pl-3 col-form-label ">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control "  placeholder="Retype Password" name="confirmpassword" value="{{$record['password']}}">
                    </div>
                    @error('retypepassword')
                    <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                    @enderror
                </div>
                </article>
            </div>
            <hr>
            <!-- Profile Data -->
            <h3 class="col-6 border-bottom border-1 p-3 mr-5" >Profile Data</h3>

            <!-- image Line -->
            @if(session('role')=="Admin")
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Image</label>
                <div class="">
                    <input type="file" class="form-control p-1"  id="productimagebutton" name="image">
                </div>
                @error('image')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            @endif
            <!-- Mobile Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Mobile</label>
                <div class="">
                    <input type="text" class="form-control"  placeholder="Mobile" name="mobile"
                           value="{{isset($record->profile->mobile) ? $record->profile->mobile:""}}">
                </div>
                @error('mobile')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Address Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Address</label>
                <div class="col-10">
                    <input type="text" class="form-control"  placeholder="Address" name="address"
                           value="{{isset($record->profile->address) ? $record->profile->address:""}}">
                </div>
                @error('address')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
            <!-- Birthdate Line -->
            <div class="form-group row ">
                <label  class="col-sm-2 col-form-label">Birthdate</label>
                <div class="">
                    <input type="date" class="form-control"  placeholder="Birthdate" name="birthdate"
                           value="{{isset($record->profile->birthdate) ? $record->profile->birthdate:""}}">
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
                        @if(isset($record->profile->gender) && $record->profile->gender=='male')
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        @elseif (isset($record->profile->gender) && $record->profile->gender=='female')
                            <option value="male" >Male</option>
                            <option value="female" selected>Female</option>
                        @else
                            <option value="">Gender</option>
                            <option value="male" >Male</option>
                            <option value="female">Female</option>
                            @endif
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
                    <textarea  class="form-control"  name="aboutme" >{{isset($record->profile->aboutme) ? $record->profile->aboutme:""}}</textarea>
                </div>
                @error('aboutme')
                <small class="text-danger text-center offset-2 col-6">{{$message}}</small>
                @enderror
            </div>
             @if(session('role')=="Admin")
            <button type="submit" class="btn btn-primary">Save</button>
             @endif

        </form>
    </main>
@endsection
@section('myjquery')
    <script>
        $(document).ready(function() {
            ////Hide/show password change box
            $("#changepasswordcheck").on("change",function () {
                $("#PasswordBox").slideToggle();

            })
            //display image when chooosing image file    !!!!!Important
            $("#productimagebutton").on("change",function () {
                var myfile=$(this).val().split('\\').pop();
                // alert(myfile);
                var tmppath = URL.createObjectURL(event.target.files[0]);

                $("#productimage").attr('src',tmppath);
            })
        })
    </script>
@endsection
