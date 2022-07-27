<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $todos = ToDo::all();
        return Inertia::render('ToDos/Index', [
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $todo = new ToDo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();
        return Redirect::route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ToDo $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ToDo $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ToDo $toDo
     * @return RedirectResponse
     */
    public function update(Request $request, ToDo $toDo)
    {
        $toDo = ToDo::find($request->id);
        $toDo->title = $request->title;
        $toDo->description = $request->description;
        $toDo->save();
        return Redirect::route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $toDo = ToDo::find($id);
        $toDo->delete();
        return Redirect::route('todos.index');
    }
}
