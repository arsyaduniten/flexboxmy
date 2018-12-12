@extends('public.base')

@section('head')
<style type="text/css">
	#header{
/*	  background-image: url('/images/Background@3x.png');
*/	  background-size: contain;
	  background-repeat: no-repeat;
	  max-height: 100vh;
	  height: 100vh;
	  width:100vw;
	}
</style>
@endsection

@section('content')
<div id="header">
	<div class="container mx-auto">
		{{-- <div class="nav flex">
			<div class="flex-1">
				<p class="text-xl m-3 mt-5 text-white font-bold">FLEX</p>
			</div>
			<div class="flex-1 flex text-white">
				<a class="m-3 mt-6">HOME</a>
				<a class="m-3 mt-6">WORK</a>
				<a class="m-3 mt-6">ABOUT</a>
			</div>
			<div class="flex-1">
				<button class="text-blue-dark bg-white rounded-full p-4 m-3 shadow font-bold">Contact Us</button>
			</div>
		</div> --}}
		<form action=text-center" method="POST" enctype="multipart/form-data">
			<div class="flex">
				<label>Image 1</label>
				<input type="file" name="source" id="source-img">
			</div>
			<div class="flex">
				<label>Image 2</label>
				<input type="file" name="target" id="target-img">
			</div>
			<button type="submit">Check</button>
		</form>
	</div>
</div>
@endsection

@section('script')

@endsection