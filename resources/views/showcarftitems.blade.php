@extends('layouts.app')
        <!-- Styles -->


@section('content')
<h1>Carft Items</h1>

    <main class="container" id="itemsbox" >
        <article class="row mb-3"  >
            @foreach($records as $record)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="pt-4">
                        <img src="{{asset('images\products\\'.$record['image'])}}" style="width:100%;height: 380px;">
                        <h3>Suspendisse et.</h3>
                        <img src="{{asset('images\starsimage.png')}}" style="width:90%">
                        <article>
                            <button class="text-gray " style="border:1px solid darkgrey;height:40px;width:40px;border-radius: 50%;">
                                <a href="#" class="deletecarftitembutton" data-id="{{$record['id']}}" onclick="return confirm('Are you sure you want to delete item')"><i class="fas fa-trash"></i></a></button>
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
<script src="{{asset('js\jquery-3.5.1.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $("#itemsbox").delegate('.deletecarftitembutton',"click",function (e) {
            e.preventDefault();
            idx=$(this).attr("data-id");
            $.ajax({
                type :"get",
                datatype :"html",
                url :"{{route("deletecraftitemrt")}}",
                data :{id:idx},
                success: function (data) {
                    var htmlview=data.html;
                    var obj=$(htmlview).find("#itemsbox");
                    $("#itemsbox").html(obj);
                    $('#carftquantity').text(data.carftquantity);
                    sessionStorage.setItem("carftquantity", data.carftquantity);



                }
            })

        })

    })
</script>
