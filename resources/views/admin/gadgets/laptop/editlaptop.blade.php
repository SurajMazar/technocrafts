@extends('admin.layout')

@section('content')
	<admineditlaptop
		laptop_url='{{ route('admin.laptop') }}' brand_url='{{ route('admin.brands') }}'
		:laptop='{{ json_encode($laptop) }}'
	></admineditlaptop>
@endsection
