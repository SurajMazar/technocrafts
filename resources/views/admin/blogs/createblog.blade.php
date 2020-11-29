@extends('admin.layout')

@section('content')
<admincreateblog 
	category='{{ route('admin.blog_category_all') }}'
	create='{{ route('admin.blogs_create') }}'
	blog_page='{{ route('admin.blogs') }}'
	logged_in_user='{{ Auth::user()->id }}'
	></admincreateblog>
@endsection