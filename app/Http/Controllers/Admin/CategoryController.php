<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    protected $validationRules = [
        'name' => 'string|required|max:30|unique:categories,name'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $newCategory = new Category();
        $newCategory-> fill($request->all());
        $newCategory->slug = Str::of($newCategory['name'])->slug('-');
        $newCategory->save();

        return redirect()->route("admin.categories.index")->with('success', "La categoria {$newCategory->name} è stata creata");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation = $this->validationRules;
        $validation["name"] = $validation["name"] . ",{$category['id']}";
        
        $request->validate($validation);

        if($category->name != $request->name){

            $slug = Str::of($request->name)->slug('-');
        }
        $category->fill($request->all());
        $category->save();

        return redirect()->route("admin.categories.index")->with('success', "La categoria {$category->id} è stata modificata");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route("admin.categories.index")->with('success', "La categoria {$category->name} è stata eliminata");
    }
}
