@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a New Blog todo ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Create a New Todo

		<div class="pull-right">
			<a href="{{ route('todos') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-meta-data" data-toggle="tab">Meta Data</a></li>
</ul>

<form class="form-horizontal" method="todo" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- todo Title -->
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label" for="title">Title</label>
				<div class="controls">
					<input class="span10" type="text" name="title" id="title" value="{{ Input::old('title') }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			
			<!-- Content -->
			<div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label" for="content">Content</label>
				<div class="controls">
					<textarea class="span10" name="content" id="content" value="content" rows="10">{{ Input::old('content') }}</textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- todo Slug -->
			<div class="control-group">
				<label class="control-label" for="slug">Status</label>
				<div class="controls">
					<div class="input-prepend">					
						<input class="span6" type="text" name="slug" id="slug" value="{{ Input::old('status') }}">
					</div>
				</div>
			</div>

		</div>

	</div>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('todos') }}">Cancel</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Publish</button>
		</div>
	</div>
</form>
@stop
