@extends('front.layouts.app')
@section('content')
<div class="container">
	<div class="content">
		<div class="col-xs-12">
			@include('admin/templates/'.$oNotification->type.'_template')
		</div>
	</div>
</div>
@endsection
