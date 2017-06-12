<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::where('status', 1)->get();
    	return view('category.index', compact('categories'));
    }

    public function create()
    {
    	$categoryList = Category::pluck('name', 'id');
    	return view('category.create', compact('categoryList'));
    }

    public function store(Request $request)
    {

	    $input = Input::all();
	    $rules = ['name' => 'required|unique:categories'];
	    $messages = [
	    	'name.required' => 'The catagory name field is required.',
	    	'name.unique' => 'The catagory name field is unique.',
		];

    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    	// return $request->category_id;
    	$category = new Category;
    	$category->name = $request->name;
    	$category->parent_id = $request->parent_id;
    	$category->status = 1;
    	$category->save();
    	flash()->success('successfully inserted');
    	return redirect('category')->withInput();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->status = 2;
        $category->save();
        flash()->error('Successfully deleted');
        return redirect('/category');
    }

    public function edit($id)
    {
    	$category = Category::find($id);
    	$pCategories = Category::get();
    	return view('category.edit', compact('category', 'pCategories'));
    }
}
