<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryEditRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate(10);
        return view('admins.category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $slug = $this->createSlug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status ? 1 : 2,
        ]);

        return redirect()->route('admin.categories.index')->with('message', 'thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admins.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        $slug = $this->createSlug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status ? 1 : 2,
        ]);
        return redirect()->route('admin.categories.index')->with('message', 'sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // dd($category);
        // $id = Category::query()->findOrFail($id);
        $id = $category['id'];

        Category::destroy($id);

        return redirect()->back()->with('message', 'Xóa thành công');
    } 

    public function trashCategory()
    {
        $deletedCategories = Category::onlyTrashed()->paginate(10);

        return view('admins.category.trash', compact('deletedCategories'));
    }

    public function trashRestore(String $id)
    {
        $restoreCate = Category::withTrashed()->find($id);

        if ($restoreCate) {

            $restoreCate->restore();
            return redirect()->back()->with('success', 'Danh mục đã được khôi phục thành công');
        }
    }

    public function trashForce(String $id)
    {
        $forceCategories = Category::withTrashed()->find($id);

        if ($forceCategories) {

            $forceCategories->forceDelete();
            return redirect()->back()->with('success', 'Danh mục đã xóa vĩnh viễn');
        }
    } 
}
