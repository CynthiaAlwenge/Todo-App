@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
todo Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Todo Management

		<div class="pull-right">
			<a href="{{ route('create/todo') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $todos->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span6">@lang('admin/todos/table.title')</th>
			<th class="span2">@lang('admin/todos/table.comments')</th>
			<th class="span2">@lang('admin/todos/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($todos as $todo)
		<tr>
			<td>{{ $todo->title }}</td>
			<td>{{ $todo->comments()->count() }}</td>
			<td>{{ $todo->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/todo', $todo->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete/todo', $todo->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $todos->links() }}
@stop
