@extends('admin.layout')

@section('content')
<div class="container">
    <adminblogcategory 
    createroutes='{{ route('admin.blog_category_create') }}'
		categories='{{ route('admin.blog_category_with_pagination') }}'
    ></adminblogcategory>
</div>
@endsection
