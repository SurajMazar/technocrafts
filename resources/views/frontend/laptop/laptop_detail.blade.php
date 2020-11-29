@extends('frontend.layout')
@section('og')
<title>Laptop description</title>
@endsection

@section('content')
<div id="app">
<laptop-detail home_url='{{ route('home') }}' :laptop='{{ $laptop }}'></laptop-detail>

<emi :price='{{ $laptop->price }}'></emi>
</div>

@endsection