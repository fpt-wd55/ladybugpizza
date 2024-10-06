<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToppingRequest;
use App\Models\Category;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToppingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $toppings = Topping::latest('id')->paginate(10);
        return view('admins.toppings.index', compact('toppings', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admins.toppings.add', compact('categories'));
    }

    public function store(ToppingRequest $request)
    {
        $data = $request->except('image');
        $data['image'] = "";
        if ($request->hasFile('image')) {
            $topping_image = $request->file('image');
            $topping_name = 'topping_' . pathinfo($topping_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $topping_image->getClientOriginalExtension();
            $data['image'] = $topping_name;
            $topping_image->storeAs('uploads/toppings', $topping_name);
        }
        Topping::query()->create($data);
        return redirect()->route('admin.toppings.index')->with('message', 'Thêm Topping thành công');
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
    public function update(ToppingRequest $request, Topping $topping)
    {
        $data = $request->except('image');
        $old_image = $topping->image;
        // nếu chọn ảnh mới  
        if ($request->hasFile('image')) {
            $topping_image = $request->file('image');
            $topping_name = 'topping_' . pathinfo($topping_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $topping_image->getClientOriginalExtension();
            $data['image'] = $topping_name;
        } else {
            $data['image'] = $old_image;
        }

        if ($topping->update($data)) {
            if ($request->hasFile('image')) {
                $topping_image->storeAs('uploads/toppings', $topping_name); 
                // xóa ảnh cũ
                if ($old_image != null) {
                    unlink(storage_path('app/public/uploads/toppings/' . $old_image));
                }
            }
            return redirect()->route('admin.toppings.edit', $topping->id)->with('message', 'Cập nhật thành công');
        }
        return redirect()->route('admin.toppings.edit', $topping->id)->with('error', 'Cập nhật thất bại');
    }
    // xóa mềm dữ liệu
    public function destroy(Topping $topping)
    {
        $topping->delete();
        return back()->with('message', 'Xóa thành công');
    }
    // thùng rác
    public function trashTopping()
    {
        $categories = Category::all();
        $listTopping = Topping::onlyTrashed()->latest('id')->paginate(10);
        return view('admins.toppings.trash', compact('categories', 'listTopping'));
    }
    // khôi phục
    public function resTopping($id)
    {
        $topping = Topping::withTrashed()->find($id);
        $topping->restore();

        return back()->with('message', 'Khôi phục thành công');
    }
    // xóa vĩnh viễn
    public function forceDestroy($id)
    {
        $topping = Topping::withTrashed()->find($id);
        $old_image = $topping->image;
        // xóa ảnh cũ
        if ($old_image != null) {
            unlink(storage_path('app/public/uploads/toppings/' . $old_image));
        }
        $topping->forceDelete();
        return back()->with('message', 'Đã xóa vĩnh viễn !');
    }
}
