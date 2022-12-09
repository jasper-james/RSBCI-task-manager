@extends('layouts.app')
@section('content')
<div class="container justify-content-between align-items-center">
        <div class="row">
            <h4 class="mb-3 col-8">All Tasks</h4>
            <div class="col text-end">
                <a href="{{route('tasks.create')}}" class="btn btn-dark btn-icon-text">Add New Task</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    {{csrf_field()}}
                    <div>
                        <label for="taskname">Task Name</label>
                        <input type="text" name="taskname">
                    </div>
                    <div>
                        <label for="details">Description</label>
                        <input type="text" name="details">
                    </div>
                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection