@extends('admin.layout')

@section('content')
<div id="app">
<noticeboard :user="{{ Auth::user() }}"></noticeboard>
</div>
@endsection