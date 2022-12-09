<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule; 

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $id = Auth::id();
        $tasks = DB::table('tasks')->where('user_id', '=', $id)->where('deleted_at', NULL)->get();
        return view('tasks.index', ['tasks' => $tasks]);
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
        $id = Auth::id();
        $request->validate([
            'taskname'  =>  [
                'required', 
                'max:255',
                'min:3', 
                Rule::unique('tasks')->where(function($query) {
                    $query->where('user_id', '=', Auth::id());
                })
             ],
            'details'   =>  'required'
        ]);

        $input = $request->taskname;
        $details = $request->details;
        $id = Auth::id();
        Tasks::create([
            'user_id'   =>  $id,
            'taskname'  =>  $input,             
            'details'   =>  $details,            
            'status'   =>  'TODO',
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $renameTask = Tasks::where('id', $id)->first();        
        return view('tasks.show', compact('renameTask'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $renameTask = Tasks::where('id', $id)->first();        
        return view('tasks.edit', compact('renameTask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $id = $request->task_id;
        $data = Tasks::where('id', $id)->first();
        $data->taskname = $request->taskname;
        $data->status = $request->status;
        $data->details = $request->details;
        $data->update();
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tasks::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Task deleted successfully');
    }
}
