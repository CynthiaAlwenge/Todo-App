<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Todo;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class TodosController extends AdminController {

	/**
	 * Show a list of all the blog todos.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the blog todos
		$todos = Todo::orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend/todos/index', compact('todos'));
	}

	/**
	 * Blog todo create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Show the page
		return View::make('backend/todos/create');
	}

	/**
	 * Blog todo create form processing.
	 *
	 * @return Redirect
	 */
	public function todoCreate()
	{
		die('herhe');
		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new blog todo
		$todo = new Todo;

		// Update the blog todo data
		$todo->title            = e(Input::get('title'));
		$todo->content          = e(Input::get('content'));
		$todo->status           = e(Input::get('meta-status'));		
		$todo->user_id          = Sentry::getId();

		// Was the blog todo created?
		if($todo->save())
		{
			// Redirect to the new blog todo page
			return Redirect::to("admin/todos/$todo->id/edit")->with('success', Lang::get('admin/todos/message.create.success'));
		}

		// Redirect to the blog todo create page
		return Redirect::to('admin/todos/create')->with('error', Lang::get('admin/todos/message.create.error'));
	}

	/**
	 * Blog todo update.
	 *
	 * @param  int  $todoId
	 * @return View
	 */
	public function getEdit($todoId = null)
	{
		// Check if the blog todo exists
		if (is_null($todo = Todo::find($todoId)))
		{
			// Redirect to the todos management page
			return Redirect::to('admin/todos')->with('error', Lang::get('admin/todos/message.does_not_exist'));
		}

		// Show the page
		return View::make('backend/todos/edit', compact('todo'));
	}

	/**
	 * Blog Todo update form processing page.
	 *
	 * @param  int  $todoId
	 * @return Redirect
	 */
	public function todoEdit($todoId = null)
	{
		// Check if the blog todo exists
		if (is_null($todo = Todo::find($todoId)))
		{
			// Redirect to the todos management page
			return Redirect::to('admin/todos')->with('error', Lang::get('admin/todos/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the blog todo data
		$todo->title            = e(Input::get('title'));
		$todo->content          = e(Input::get('content'));
		$todo->status           = e(Input::get('status'));
		

		// Was the blog todo updated?
		if($todo->save())
		{
			// Redirect to the new blog todo page
			return Redirect::to("admin/todos/$todoId/edit")->with('success', Lang::get('admin/todos/message.update.success'));
		}

		// Redirect to the todos todo management page
		return Redirect::to("admin/todos/$todoId/edit")->with('error', Lang::get('admin/todos/message.update.error'));
	}

	/**
	 * Delete the given blog todo.
	 *
	 * @param  int  $todoId
	 * @return Redirect
	 */
	public function getDelete($todoId)
	{
		// Check if the blog todo exists
		if (is_null($todo = Todo::find($todoId)))
		{
			// Redirect to the todos management page
			return Redirect::to('admin/todos')->with('error', Lang::get('admin/todos/message.not_found'));
		}

		// Delete the blog post
		$todo->delete();

		// Redirect to the blog todos management page
		return Redirect::to('admin/todos')->with('success', Lang::get('admin/todos/message.delete.success'));
	}

}
