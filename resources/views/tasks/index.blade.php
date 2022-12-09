@extends('layouts.app')
@section('content')
    <div class="container justify-content-between align-items-center">
        <div class="row">
            <h4 class="mb-3 col-8">All Tasks</h4>
            <div class="col text-end">
                <button role="button" data-toggle="modal" data-target="#TaskModal" class="btn btn-dark btn-icon-text">Add New Task</button>
            </div>
        </div>        
        <div class="modal fade" id="TaskModal" tabindex="-1" role="dialog" aria-labelledby="TaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TaskModalLabel">Add Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="taskname">Task Name</label>
                                <input class="form-control" type="text" name="taskname">
                                <small id="emailHelp" class="form-text text-muted">Task must be unique.</small>
                            </div>
                            <div class="form-group">
                                <label for="details">Description</label>
                                <textarea class="form-control" type="text" name="details" id="" cols="30" rows="2"></textarea>
                                <!-- <input type="text" name="details"> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>                
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($message = session('success'))
                    <div class="alert alert-success alert-dismissible text-success fst-bold text-center">
                        <strong>{{ $message }}</strong>
                        <button class="float-end" type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th  class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $todo)
                                <tr>
                                    <td>{{ $todo->taskname }}</td>
                                    <td>{{ $todo->details }}</td>
                                    <td>{{ $todo->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tasks.show', $todo->id) }}" class="btn btn-primary btn-sm">Show</a>
                                        <a href="{{ route('tasks.edit', $todo->id) }}" class="btn btn-warning btn-sm mx-2">Edit</a>
                                        <a href="{{ route('destroy', $todo->id) }}" class="btn btn-danger btn-sm">Delete</a>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection