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
        // Xu ly hinh anh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        $data = [
            'name' => $request->name,
            'slug' => $this->createSlug($request->name),
            'image' => $image_name,
            'status' => $request->status ? 1 : 2,
        ];

        if (Category::create($data)) {
            // Xu ly upload anh
            $image->storeAs('public/uploads/categories', $image_name);

            return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công');
        }

        return redirect()->back()->with('error', 'Thêm danh mục thất bại');
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
        // Xu ly hinh anh
        $image_name = $category->image;
        $old_image = $category->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        $data = [
            'name' => $request->name,
            'slug' => $this->createSlug($request->name),
            'image' => $image_name,
            'status' => $request->status ? 1 : 2,
        ];

        if ($category->update($data)) {
            // Xu ly upload anh
            if ($request->hasFile('image')) {
                // Luu anh moi
                $image->storeAs('public/uploads/categories', $image_name);
                // Xoa anh cu
                unlink(storage_path('app/public/uploads/categories/' . $old_image));
            }
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật danh mục thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $id = $category['id'];

        if (Category::destroy($id)) {
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa danh mục thất bại');
        }
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
        } else {
            return redirect()->back()->with('error', 'Khôi phục danh mục thất bại');
        }
    }

    public function trashForce(String $id)
    {
        $forceCategories = Category::withTrashed()->find($id);
        $old_image = $forceCategories->image;
        if ($forceCategories) {
            if ($old_image != null) {
                unlink(storage_path('app/public/uploads/categories/' . $old_image));
            }
            $forceCategories->forceDelete();
            return redirect()->back()->with('success', 'Danh mục đã xóa vĩnh viễn');
        } else {
            return redirect()->back()->with('error', 'Xóa vĩnh viễn danh mục thất bại');
        }
    }
    public function export()
    {
        $categories = Category::all();
        $this->exportExcel($categories, 'danhsachdanhmuc');
    }

    public function search(Request $request)
    {
        $category = Category::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        return view('admins.category.list', compact('category'));
    }
}
