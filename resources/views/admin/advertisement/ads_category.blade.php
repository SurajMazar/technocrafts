@extends('admin.layout')

@section('content')
<admin-ads-category ads_category_url='{{ route('admin.ads_category') }}'></admin-ads-category>
@endsection