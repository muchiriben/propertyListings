@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('page_title')
<h1 class="text-center">My Listings</h1>
@endsection

@section('content')

<div class="container">
    @yield('page_title')
    
    @if (count($properties) > 0)
    @foreach ($properties as $property)
       <div class="card card-body bg-light">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                <img style="width:100%" src="/storage/property_images/{{$property->image}}" alt="Property One Image">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="{{ route('admin.properties.show', $property->property_id) }}">{{$property->title}}</a></h3>
                    <h3>{{$property->address}}</h3>
                    <small>Status: {{$property->status}}</small><br>
                    <small>Uploaded on: {{$property->created_at}}</small>
                </div>
            </div>
       </div><br>
    @endforeach
    {{$properties->links()}}
@else
    <p class="text-center">No properties Found</p>
@endif
</div>

@endsection