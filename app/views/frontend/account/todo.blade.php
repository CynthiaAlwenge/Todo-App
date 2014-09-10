@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Your Profile
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
	<h4>Update your Todo</h4>
</div>

<form method="post" action="" class="form-vertical" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Title -->
	<div class="control-group{{ $errors->first('title', ' error') }}">
		<label class="control-label" for="title">Title</label>
		<div class="controls">
			<input class="span4" type="text" name="title" id="title" value="{{ Input::old('title', $todo->title) }}" />
			{{ $errors->first('title', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Content -->
	<div class="control-group{{ $errors->first('content', ' error') }}">
		<label class="control-label" for="content">Content</label>
		<div class="controls">
			<input class="span4" type="text" name="content" id="content" value="{{ Input::old('content', $todo->content) }}" />
			{{ $errors->first('content', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- status URL -->
	<div class="control-group{{ $errors->first('status', ' error') }}">
		<label class="control-label" for="status">Status</label>
		<div class="controls">
			<input class="span4" type="text" name="status" id="status" value="{{ Input::old('status', $todo->status) }}" />
			{{ $errors->first('status', '<span class="help-block">:message</span>') }}
		</div>
	</div>
	

	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update your Profile</button>
		</div>
	</div>
</form>
@stop
