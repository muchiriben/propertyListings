@extends('layouts.agents_layout')

@section('stylesheets')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('page_title')
<h3>Create a new listing</h3>
@endsection

@section('content')

@yield('page_title')
<hr>
{!! Form::open(['action' => 'Agents\PropertiesController@store', 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
  <div class="form-group">
    {{Form::label('title', 'Title')}} 
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fa fa-address-card"></i>
        </div>
      </div> 
      {{Form::text('title', '' , ['class' => 'form-control', 'aria-describedby' => 'textHelpBlock', 'placeholder' => 'Title of the property'])}}
    </div> 
    <span id="textHelpBlock" class="form-text text-muted">E.g 3 acre land in Karen</span>
  </div>

  <div class="form-group">
    {{Form::label('description', 'Description')}} 
    {{Form::textarea('description', '' , ['class' => 'form-control', 'aria-describedby' => 'textHelpBlock', 'placeholder' => 'Property Description'])}} 
    <span id="textareaHelpBlock" class="form-text text-muted">Breif description of the listing (150 words)</span>
  </div>

  <div class="form-group">
    {{Form::label('type', 'Type of Property')}}
    {{Form::select('type',

    ['For Rent' => 'For Rent', 
    'For Sale' => 'For Sale',
    'Lots and Land' => 'Lots',
    'Other' => 'Other',]

    , null, ['placeholder' => 'Choose type of Property', 'class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('address', 'Address')}} 
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fa fa-address-book"></i>
        </div>
      </div> 
      {{Form::text('address', '' , ['class' => 'form-control', 'aria-describedby' => 'text1HelpBlock', 'placeholder' => 'Physical Address of property'])}}
    </div> 
    <span id="text1HelpBlock" class="form-text text-muted">E.g Kibera in Nairobi</span>
  </div> 

  <div class="form-group">
    {{Form::label('image', 'Property Image')}}<br> 
    {{Form::file('image')}}
    <span id="textHelpBlock" class="form-text text-muted">Property Image</span>
  </div>

  {{Form::submit('Submit', ['class' => 'btn btn-primary', 'value' => 'Create'])}}
{!! Form::close() !!}

@endsection


@section("js")

<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection
