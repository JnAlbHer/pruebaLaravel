@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Mis tareas
                    <a class="btn btn-sm btn-primary float-right" href="{{url("/tasks/create") }}">
                    Agregar Tarea
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($tasks->count())
                    <h5>
                        {{ $user->name }} tiene 
                        {{ $tasks->count() }} Tareas
                    </h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $index => $task)
                            <tr>
                                <td>{{ $task->title}}</td>
                                <td>{{ $task->time}}</td>
                                <td>
                                    {{ $task->status ? 'Terminada':'Pendiente'}}
                                    
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{url("/tasks/$task->id") }}">
                                        Ver
                                    </a>
                                    <form method="POST" action="{{ url("/tasks/$task->id") }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <button class="btn btn-warning">
                                            Cambiar estado
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ url("/tasks/$task->id") }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    {{ $user->name }} no tiene tareas
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
