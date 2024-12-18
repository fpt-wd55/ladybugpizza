<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToppingRequest;
use App\Models\Category;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $data['slug'] = time() . '-' . Str::slug($request->name);
        if ($request->hasFile('image')) {
            $topping_image = $request->file('image');
            $topping_name = 'topping_' . pathinfo($topping_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $topping_image->getClientOriginalExtension();
            $data['image'] = $topping_name;
            $topping_image->storeAs('public/uploads/toppings', $topping_name);
        }
        Topping::query()->create($data);
        return redirect()->route('admin.toppings.index')->with('success', 'Thêm Topping thành công');
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
        $data['slug'] = time() . '-' . Str::slug($request->name);

        if ($topping->update($data)) {
            if ($request->hasFile('image')) {
                $topping_image->storeAs('public/uploads/toppings', $topping_name);
                // xóa ảnh cũ
                if ($old_image != null) {
                    unlink(storage_path('app/public/uploads/toppings/' . $old_image));
                }
            }
            return redirect()->route('admin.toppings.edit', $topping->id)->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('admin.toppings.edit', $topping->id)->with('error', 'Cập nhật thất bại');
    }

    // xóa mềm dữ liệu
    public function destroy(Topping $topping)
    {
        $topping->delete();
        return back()->with('success', 'Xóa thành công');
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

        return back()->with('success', 'Khôi phục thành công');
    }

    // xóa vĩnh viễn
//    public function forceDestroy($id)
//    {
//        $topping = Topping::withTrashed()->find($id);
//        $old_image = $topping->image;
//        // xóa ảnh cũ
//        if ($old_image != null) {
//            unlink(storage_path('app/public/uploads/toppings/' . $old_image));
//        }
//        $topping->forceDelete();
//        return back()->with('success', 'Đã xóa vĩnh viễn!');
//    }

    public function export()
    {
        $this->exportExcel(Topping::all(), 'danhsachtopping');
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        // $toppings = Topping::latest('id')->paginate(10);
        $toppings = Topping::where('name', 'like', '%' . $request->search . '%')
            ->latest('id')
            ->paginate(10);
        $toppings->appends(['search' => $request->search]);
        return view('admins.toppings.index', compact('toppings', 'categories'));
    }

    public function filter(Request $request)
    {
        $query = Topping::query();

        if (isset($request->filter_category)) {
            $query->whereIn('category_id', $request->filter_category);
        }

        if (isset($request->filter_price_min)) {
            $query->where('price', '>=', $request->filter_price_min);
        }

        if (isset($request->filter_price_max)) {
            $query->where('price', '<=', $request->filter_price_max);
        }

        $toppings = $query->paginate(10);

        $toppings->appends(['filter_category' => $request->filter_category]);
        $toppings->appends(['filter_price_min' => $request->filter_price_min]);
        $toppings->appends(['filter_price_max' => $request->filter_price_max]);

        $categories = Category::all();

        return view('admins.toppings.index', compact('toppings', 'categories'));
    }

    public function bulkAction(Request $request)
    {
        $selectedIds = explode(',', $request->input('selected_ids'));
        $action = $request->input('action');

        if ($action == 'delete') {
            Topping::whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with('success', 'Xóa topping thành công');
        } else if ($action == 'force_delete') {
            foreach ($selectedIds as $id) {
                $forceTopping = Topping::withTrashed()->find($id);
                $old_image = $forceTopping->image;
                if ($forceTopping) {
                    if ($forceTopping->image != null) {
                        try {
                            // Kiểm tra tồn tại ảnh topping
                            if (file_exists(storage_path('app/public/uploads/toppings/' . $old_image))) {
                                unlink(storage_path('app/public/uploads/toppings/' . $old_image));
                            }
                        } catch (\Exception $e) {
                            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
                        }
                    }
                    $forceTopping->forceDelete();
                } else {
                    return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
                }
            }
            return redirect()->back()->with('success', 'Xóa vĩnh viễn topping thành công');
        } else if ($action == 'restore') {
            Topping::withTrashed()->whereIn('id', $selectedIds)->restore();
            return redirect()->back()->with('success', 'Khôi phục topping thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
    }
}
