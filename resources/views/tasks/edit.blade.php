@extends('layouts.app')
@section('content')
    <div class="container justify-content-between align-items-center">
        <div class="row">
            <h4 class="mb-3 col-8">Edit Task Details</h4>
            <div class="col text-end">
                <a href="/tasks" class="btn btn-dark btn-icon-text">View All Tasks</a>
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
                    <form method="POST" action="/update">   
                        {{csrf_field()}}            
                        <input type="text" class="form-control" name="task_id" value="{{ $renameTask->id }}" hidden>
                        <table class="table table-sm  mb-0">
                            <tr>
                                <th>Task Name</th>
                                <td><input value="{{ $renameTask->taskname }}" name="taskname" type="text" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><input value="{{ $renameTask->details }}" name="details" type="text" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <select class="form-control" name="status" id="selectStatus">
                                        <option value="{{ $renameTask->status }}" selected>{{ $renameTask->status }}</option>
                                        <option>DOING</option>
                                        <option>DONE</option>
                                    </select>
                                </td>
                            </tr>
                        </table>  
                        <div class="text-end mt-3">
                            <a href="/tasks" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-2 px-3">Save</button>
                        </div>                      
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection