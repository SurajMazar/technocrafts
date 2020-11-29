@extends('admin.layout')

@section('content')
<adminaddlaptop laptop_url='{{ route('admin.laptop') }}' brand_url='{{ route('admin.brands') }}'></adminaddlaptop>
@endsection