@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mis tareas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $user->name }} tiene 
                    {{ $tasks->count() }} Tareas

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
                                <td>{{ $task->status ? 'Terminada':'Pendiente'}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url("/tasks/$task->id") }}">
                                        Ver
                                    </a>
                                    <a class="btn btn-warning" href="{{url("/tasks/$task->id/edit") }}">
                                        Editar
                                    </a>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
