<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $user->load('tasks');

        return view(
            'tasks.index',[
                "user" => $user,
                "tasks" => $user->tasks
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middeleware('auth');
        $this->validate(
            $request, [
                "title" => "required|string|max:255",
                "time" => "required|date"
            ]
        );
        $user = Auth::user();
        $user->tasks()->create($request->all());
        return redirect('/tasks')->with('status','Tarea agregada!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $user = Auth::user();
        if($user->id === $task->user_id)
        return view(
            'tasks.show',[
                "user" => $user,
                "task" => $task
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $user = Auth::user();

        //$user->load('tasks');
        /*return view(
            'tasks.edit',[
                "user" => $user,
                "task" => $task,
                "status" => $task->status
            ]
        );*/

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
       /*Task::find($task->id);
        $task->status=!$task->status;
        return redirect()->route('tasks.index')->with('success','El status se ha modificado');*/
        $user = Auth::user();
        if($user->id === $task->user_id){
            $task->update(
                ["status" => !$task->status]
            );
            return back()->with('status','El estado de la tarea ha cambiado');
        }
        return back()->with('status','No puedes editar esta tarea');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        /*Task::find($task->id)->delete();
        return redirect()->route('tasks.index')->with('success','El registro ha sido eliminado');*/
        $user = Auth::user();
        if($user->id === $task->user_id){
            $task->delete();
            return back()->with('status','La tarea se ha eliminado');
        }
        return back()->with('status','No puedes eliminar esta tarea');
    }
}
