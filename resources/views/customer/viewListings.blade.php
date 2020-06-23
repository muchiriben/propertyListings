@extends('layouts.client_layout')

@section('page_title')
    <h1 class="text-center">Property Listings</h1>
@endsection

@section('content')
 @include('properties.index')
@endsection