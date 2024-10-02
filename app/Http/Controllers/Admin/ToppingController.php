<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToppingRequest;
use App\Http\Requests\UpdateToppingRequest;
use App\Models\Category;
use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $listToppings = Topping::latest('id')->paginate(10);
        return view('admins.toppings.home', compact('listToppings', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admins.toppings.add', compact('categories'));
    }

    public function store(AddToppingRequest $request)
    {
        // dd($request->all());
        $data = $request->except('image');
        $data['image'] = "";
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('uploads/toppings');
            $data['image'] = $path_image;
        }
        Topping::query()->create($data);
        return redirect()->route('toppings.index')->with('message', 'Thêm Topping thành công');
    }
    public function show(Topping $topping)
    {
        //
    }
    public function edit(Topping $topping)
    {
        $categories = Category::all();
        return view('admins.toppings.edit', [
            'editTopping' => $topping,
            'categories' => $categories,
        ]);
    }
    public function update(UpdateToppingRequest $request, Topping $topping)
    {
        $data = $request->except('image');
        $old_image = $topping->image; // giữ lại ảnh cũ
        $data['image'] = $old_image;
        // nếu chọn ảnh mới 
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('uploads/toppings');
            $data['image'] = $path_image;
        }
        $topping->update($data);
        // if ($request->hasFile('image')) {
        //     if (file_exists('storage/' . $old_image)) {
        //         unlink('storage/' . $old_image);
        //     }
        // }
        return redirect()->route('toppings.index')->with('message', 'Sửa thành công');
    }

    // xóa mềm dữ liệu
    public function destroy(Topping $topping)
    {
        $topping->delete();
        return back()->with('message','Xóa thành công');
    }
    // thùng rác
    public function trashTopping()
    {
        $categories = Category::all();
        $listToppings = Topping::onlyTrashed()->latest('id')->paginate(10);
        return view('admins.toppings.trash', compact('categories', 'listToppings'));
    }
    // khôi phục
    public function resTopping($id)
    {
        $topping = Topping::withTrashed()->find($id);
        $topping->restore();

        return back()->with('message','Khôi phục thành công');
    }
    // xóa vĩnh viễn
    public function forceDestroy($id)
    {
        $topping = Topping::withTrashed()->find($id);
        $topping->forceDelete();
        return back()->with('message','Đã xóa vĩnh viễn !');
    }
}
