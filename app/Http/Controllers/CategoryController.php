<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use Auth;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return view('category',['categories'=> $categories]);
    }

    public function deleteCategory(Request $request)
    {
        $category_id = $request->id;
        $category = Category::find($category_id);
        if ($category) {
            $category->delete();
            return redirect('category')->with('success', 'Category deleted successfully');
        }
        else
        {
            return redirect('category')->with ('error', 'Category not found');
        }
    }

    public function categoryAdd(Request $request)
    {
        $request->validate([
            'category'=>['required']
        ]);
        $name = $request->category;

        Category::create([
            'name'=>$name
        ]);
        return redirect('category')->with('added', 'Category added successfully');
    }
}
