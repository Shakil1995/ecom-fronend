@extends('layouts.app')

@section('content')
    <div><a href="{{ route('products.index') }}">Product Index</a></div>
    <div><a href="{{ route('categories.index') }}">Category Index</a></div>
    <div><a href="{{ route('priceTypes.index') }}">Price Type Index</a></div>

@endsection