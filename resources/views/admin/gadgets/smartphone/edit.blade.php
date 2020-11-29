
@extends('admin.layout')

@section('content')
<div id="app">
	<admin-edit-smartphone :smartphone='{{ json_encode($smartphones) }}'></admin-edit-smartphone>
</div>
@endsection
