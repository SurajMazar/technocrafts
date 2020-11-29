@extends('frontend.layout')
@section('og')
<title>Technocrafts - Become a writer</title>
@endsection
@section('content')

<div id="app">
	<div class="container pt-2">
		<div class="row justify-content-center">
			
			<div class="col-md-8">
				<h1 class='heading text-center'>Do you want to <span class='title-emphasis'>become a writer</span> for Technocrafts?</h1>
			</div>

		</div>

		<div class="row justify-content-center pt-4">

			<div class='col-md-6'>
				<first-image></first-image>
			</div>
		</div>

		<div class="row justify-content-center pt-4">
			<div class="col-md-8">
				<p class="text-center para">Technocrafts is aimed to provide information to its user about the ongoing tech evolutions. So, we encourage young writers by giving them a chance to become an author of technocrafts. All u have to do is follow the below steps.</p>
			</div>
		</div>

		<div class="row pt-4">

			<div class="col-md-6" style="margin:auto;">
				<h5 class=" heading text-center">1. <span class='title-emphasis'>Write</span> Something</h5>
				<p class="text-center para">At first you have to write something. It can be about anything. We just want see your writing skills. You can write on the form which appears when clicked on the "Submit writting" button at the bottom.</p>
			</div>

			<div class="col-md-6">
				<writing-image></writing-image>
			</div>
		</div>

		<div class="row pt-4">
			<div class="col-md-6">
				<attachment-image></attachment-image>
			</div>

			<div class="col-md-6" style="margin:auto;">
				<h5 class=" heading text-center">2. <span class='title-emphasis'>Submit</span> your writing</h5>
				<p class="text-center para">After writing  send your submissions by clicking the submit button on the form ... but becareful dont submit before completing your writing.</p>
			</div>
		</div>


		<div class="row pt-4">
			<div class="col-md-6" style="margin:auto;">
				<h5 class=" heading text-center">3. <span class='title-emphasis'>Reviewing</span> your writing</h5>
				<p class="text-center para">Your submissions will be reviewed and you will be informed about your acceptance. You will also be provided with feedbacks if necessary.</p>
			</div>


			<div class="col-md-6">
				<review-image></review-image>
			</div>

		</div>

		<div class="row pt-4">
			<submission-from></submission-from>
		</div>



	</div>
</div>
@endsection