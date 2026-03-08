<?php

namespace App\Http\Controllers;
use App\Models\Task;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $tasks = Task::with('user')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator= FacadesValidator::make($request->all(),[
        'title' => 'required|max:255',
        'description' => 'required',
        'status' => 'required|in:Pending,Completed',
        'due_date' => 'required|date'
       ]);
        if ($validator->fails()) {
        return redirect(route('tasks.create'))->withErrors($validator)->withInput();
         }
            // Make sure you have 'use Illuminate\Support\Facades\Auth;' at the top
            $user = Auth::user();
            $task= new Task();
             $task->title = $request->title;
             $task->description = $request->description;
             $task->status = $request->status;
             $task->due_date = $request->due_date;
             $task->user_id = $user->id;
             $task->save();

            return redirect()->route('dashboard')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $task = Task::findOrFail($id);
    return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validate the incoming data
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'status' => 'required',
                'due_date' => 'required',
            ]);

            // 2. Find the task by ID
            $task = Task::findOrFail($id);

            // 3. Update the data
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'due_date' => $request->due_date,
            ]);
            // 4. Redirect the user back to the dashboard with a success message
            return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);    
        // This now "Soft Deletes" automatically
        $task->delete(); 
        return redirect()->route('dashboard')->with('success', 'Task moved to trash!');
    }
   public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
