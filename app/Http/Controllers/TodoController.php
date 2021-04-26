<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodoCreateRequest;
use App\Models\Step;




class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //$todos = auth()->user()->todos()->sortBy('completed')->get();
        $todos = auth()->user()->todos()->orderBy('completed')->get();
        return view('todos.index',compact("todos"));
    }


    public function create()
    {
        return view('todos.create');
    }

    public function show(Todo $todo)
    {
        return view('todos.show')->with(['todo'=>$todo]);
    }


    public function store(TodoCreateRequest $request)
    {
        //dd($request->all());
        //dd(auth()->user()->todos);
        //$userId          = auth()->id();
        //$request['user_id'] = $userId;
        //Todo::create($request->all());
        //dd($request->all());
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step){
             foreach ($request->step as $step ) {
            $todo->steps()->create(['name' => $step]);
        }
    }
        return redirect(route('todo.index'))->with('message','Todo Created Successfully');

        //$rules = ['title' => 'required|max:255',
            
        //];
        //$messages = [
        //    'title.max' => 'Todo title should not be greater than 255 characters',
        //];
       // $validator = Validator::make($request->all(), $rules, $messages);
        //if($validator->fails()){
        //    return redirect()->back()->withErrors($validator)->withInput();

        //}
        
       //$request->validate([
       //    'title' => 'required|max:255',
      // ]);
    }

    public function edit(Todo $todo)
    {
        return view ('todos.edit',compact('todo'));
    }


    public function update(TodoCreateRequest $request, Todo $todo){
        $todo->steps()->delete();
        $todo->update(['title'=>$request->title, 'description'=>$request->description]);
        if($request->stepName){
            foreach ($request->stepName as $key => $value){
                $todo->steps()->create(['name'=>$value]);
            }
        }
        return redirect(route('todo.index'))->with('message', 'Task updated!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return redirect()->back()->with('message', 'Task completed');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return redirect()->back()->with('message', 'Task Incompleted');
    }

    public function destroy(Todo $todo)
    {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted');
    }
}
