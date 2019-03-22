@extends('layouts.master')

@section('css')
@endsection
@section('content')
@auth
{{-- @php var_dump($data);@endphp --}}
<div class="container">
    <div class="row">
        @foreach ($data as $value)
        <div class="col-md">
           <div class="card">
                {{-- <img class="card-img-top" src="{{$value->imglink}}" alt="Card image cap"> --}}
                <div class="card-body">
                    <h5 class="card-title">{{$value->level_name}}</h5>
                    <a href="deital/{{$value->building_id}}/{{$value->id}}" class="btn btn-primary">See more</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endauth
@endsection
