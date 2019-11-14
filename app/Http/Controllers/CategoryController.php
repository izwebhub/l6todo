<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('categories.index');
    }

    public function save()
    {
        $name = request('name');
        $description = request('description');
        $check = Category::where('name', $name)->count();
        if ($check) {
            return response()->json([
                "error" => true,
                "msg"   => "Category exists!"
            ]);
        } else {
            $cat = new Category;
            $cat->name = $name;
            $cat->description = $description;
            $cat->save();
            return response()->json([
                "error" => false,
                "msg"   => "Successfully added!"
            ]);
        }
    }

    public function destroy($id) {
        Category::find($id)->delete();
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update() {
        $name = request('name');
        $id   = request('catId');
        $description = request('description');
        $check = Category::where('name', $name)->where('id', '!=', $id)->count();
        if ($check) {
            return response()->json([
                "error" => true,
                "msg"   => "Category exists!"
            ]);
        } else {
            $cat = Category::find($id);
            $cat->name = $name;
            $cat->description = $description;
            $cat->save();
            return response()->json([
                "error" => false,
                "msg"   => "Successfully added!"
            ]);
        }
    }

    public function changeStatus($id) {
        $changeTo = request('title');
        if ($changeTo == "Activate Category") {
            $user = Category::find($id);
            $user->active = 1;
            $user->save();
        } else {
            $user = Category::find($id);
            $user->active = 0;
            $user->save();
        }
    }

}
