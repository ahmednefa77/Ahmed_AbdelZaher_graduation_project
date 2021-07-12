@extends('layouts.app')
        <!-- Styles -->


@section('content')
<h1>Search for {{$categoryname}}</h1>

    <main class="container" >
        <article class="row mb-3">
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
                                <a href="#" class="text-gray " ><i class="fas fa-share-alt"></i></a></button>
                        </article>
                    </div>
                </div>
@endforeach
        </article>

    </main>

@if(count($records)==0)

    <h1 class="alert  text-center mx-auto w-50" style="background-color: green">No Result Found</h1>
@endif

@endsection

