<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    //
    public function index()
    {
        return view('todos.index');
    }

    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->status = 'COMPLETED';
        $todo->complete_date = \Carbon\Carbon::now();
        $todo->save();
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit', compact('todo'));
    }

    public function update()
    {
        $title        = request('title');
        $description  = request('description');
        $todoId       = request('todo_id');
        $endDate      = \Carbon\Carbon::parse(request('endDate'))->format('Y-m-d');
        $startDate    = \Carbon\Carbon::parse(request('startDate'))->format('Y-m-d');
        $category     = request('category');

        $check = Todo::where('title', $title)->where('category_id', $category)->where('id', '!=', $todoId)->count();



        if ($check == 0) {
            $todo = Todo::find($todoId);
            $todo->title = $title;
            $todo->description = $description;
            $todo->start_date = $startDate;
            $todo->due_date = $endDate;
            $todo->created_by = auth()->user()->id;
            $todo->category_id = $category;


            $sd = new \Carbon\Carbon($startDate);
            $ed = new \Carbon\Carbon($endDate);

            if (!$sd->isBefore($ed)) {
                return response()->json([
                    "error" => true,
                    "msg"   => "End Date should be after start Date!"
                ]);
            }

            $todo->save();


            return response()->json([
                "error" => false,
                "msg"   => "Successfully added!"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "msg"   => "Todo exists!"
            ]);
        }
    }


    public function destroy($id)
    {
        Todo::find($id)->delete();
    }

    public function view($id)
    {
        $todo = Todo::find($id);
        return view('todos.view', compact('todo'));
    }

    public function save()
    {

        $title        = request('title');
        $description  = request('description');
        $endDate      = \Carbon\Carbon::parse(request('endDate'))->format('Y-m-d');
        $startDate    = \Carbon\Carbon::parse(request('startDate'))->format('Y-m-d');
        $category     = request('category');

        $check = Todo::where('title', $title)->where('category_id', $category)->count();

        if ($check == 0) {
            $todo = new Todo;
            $todo->title = $title;
            $todo->description = $description;
            $todo->start_date = $startDate;
            $todo->due_date = $endDate;
            $todo->created_by = auth()->user()->id;
            $todo->category_id = $category;


            $sd = new \Carbon\Carbon($startDate);
            $ed = new \Carbon\Carbon($endDate);

            if (!$sd->isBefore($ed)) {
                return response()->json([
                    "error" => true,
                    "msg"   => "End Date should be after start Date!"
                ]);
            }

            $todo->save();


            return response()->json([
                "error" => false,
                "msg"   => "Successfully added!"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "msg"   => "Todo exists!"
            ]);
        }
    }
}
