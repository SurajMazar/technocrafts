@extends('admin.layout')

@section('content')
<adminblog 
	create='{{ route ('admin.blogs_create_page') }}' 
	blogs='{{ route('admin.blog_with_pagination') }}'
	blog_edit='{{ route('admin.blogs') }}'
	:user='{{ json_encode(Auth::user()) }}'
></adminblog>
@endsection
