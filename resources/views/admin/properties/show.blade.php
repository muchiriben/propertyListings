@extends('layouts.admin_layout')

@section('content')

<h1 class="text-center">Property</h1>
<div class="card card-body bg-light">
       <h3>{{$property->title}}</h3>
       <img style="height: 400px;" src="/storage/property_images/{{$property->image}}" alt="Property Image">
       <br><br>
       <p>{{$property->description}}</p>
       <hr>
       <small>Post By: {{$property->status}}</small>
       <small>Written on {{$property->created_at}}</small>
      
</div><br>
@if (!Auth::guest())   
@if (Auth::user()->id == $property->agent_id)
    
<a href="{{route('admin.properties.edit', $property->property_id)}}" class="btn btn-primary">Edit</a>

<!--delete property -->
{!!Form::open(['action' => ['Admin\AdminPropertiesController@destroy', $property->property_id] , 'method' => 'POST', 'class' => 'float-right'])!!}

{{Form::hidden('_method' , 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

{!!Form::close()!!}

@endif
@endif

@endsection

@section("js")

<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection
