@extends('auth.Admin.Adminmaster')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center p-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <h1> You are {{session('role')}}</h1>


            </div>
        </div>
    </div>
</div>
@endsection
