<?php

class TodosController extends \BaseController {

	/**
	 * Display a listing of todos
	 *
	 * @return Response
	 */
	public function index()
	{
		$todos = Todo::all();

		return View::make('todos.index', compact('todos'));
	}

	/**
	 * Show the form for creating a new todo
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('todos.create');
	}

	/**
	 * Store a newly created todo in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Todo::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Todo::create($data);

		return Redirect::route('todos.index');
	}

	/**
	 * Display the specified todo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$todo = Todo::findOrFail($id);

		return View::make('todos.show', compact('todo'));
	}

	/**
	 * Show the form for editing the specified todo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$todo = Todo::find($id);

		return View::make('todos.edit', compact('todo'));
	}

	/**
	 * Update the specified todo in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo = Todo::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Todo::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$todo->update($data);

		return Redirect::route('todos.index');
	}

	/**
	 * Remove the specified todo from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Todo::destroy($id);

		return Redirect::route('todos.index');
	}

}
