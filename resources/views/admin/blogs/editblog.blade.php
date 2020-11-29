@extends('admin.layout')

@section('content')
<admineditblog
	category='{{ route('admin.blog_category_all') }}'
	blog_page='{{ route('admin.blogs') }}'
	:blog='{{ json_encode($blog)}}'
></admineditblog>
@endsection