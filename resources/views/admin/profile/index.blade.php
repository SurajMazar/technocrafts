@extends('admin.layout')

@section('content')
<div id="app">
<user-profile :user="{{ Auth::user() }}"></user-profile>
</div>
@endsection