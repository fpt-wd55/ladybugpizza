<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('status', 'asc')->paginate(6);

        return view('admins.banner.list',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.banner.add');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
    //    dd($request->all());
        if ($request->hasFile('image')) {
            // Lấy file hình ảnh từ request
            $banner_image = $request->file('image');
    
            // Tạo tên cho hình ảnh với cấu trúc: 'topping_' + tên gốc của file (không bao gồm phần mở rộng) + phần mở rộng gốc của file
            $banner_name = 'banner_' . pathinfo($banner_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $banner_image->getClientOriginalExtension();
    
            // Lưu hình ảnh vào thư mục 'uploads/toppings' với tên đã tạo
            $banner_image->storeAs('public/uploads/banners', $banner_name);
        }

        Banner::create([
            'image' => $banner_name,
            'url' => $request->url,
            'is_local_page' => $request->is_local_page,
            'status' => $request->status ? 1 : 2,
        ]);

        return redirect()->route('admin.banners.index')->with('message', 'thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admins.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->except('image');
        $old_image = $banner->image;
        // nếu chọn ảnh mới  
        if ($request->hasFile('image')) {
            $banner_image = $request->file('image');
            $banner_name = 'topping_' . pathinfo($banner_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $banner_image->getClientOriginalExtension();
            $data['image'] = $banner_name;
        } else {
            $data['image'] = $old_image;
        }

        $data['status'] = $request->status ? 1 : 2;

        if ($banner->update($data)) {
            if ($request->hasFile('image')) {
                $banner_image->storeAs('public/uploads/banners', $banner_name); 
                // xóa ảnh cũ
                if ($old_image != null && Storage::exists('public/uploads/banners/' . $old_image)) {
                    unlink(storage_path('app/public/uploads/banners/' . $old_image));
                }
            }
            return redirect()->route('admin.banners.index')->with('message', 'Cập nhật thành công');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $id = $banner['id'];

        Banner::destroy($id);

        return redirect()->back()->with('message', 'Xóa thành công');
    }

    public function trashList(Banner $banner)
    {
        $deleteBanner = Banner::onlyTrashed()->paginate(10);

        return view('admins.banner.trash',compact('deleteBanner'));
    }
    // xóa cứng
    public function trashForce(String $id)
    {
        $banner = Banner::withTrashed()->find($id);
        $old_banner = $banner->image;
        // dd($old_banner);
        $filePath = storage_path('app/public/uploads/banners/' . $old_banner);
        if ($old_banner != null && file_exists($filePath)) {
            unlink($filePath);
        }
        $banner->forceDelete();
        return back()->with('message', 'Đã xóa vĩnh viễn !');
    }

    // khôi phục
    public function trashRestore(String $id)
    {
        $restoreBanner = Banner::withTrashed()->find($id);

        if ($restoreBanner) {

            $restoreBanner->restore();
            return redirect()->back()->with('success', 'Danh mục đã được khôi phục thành công');
        }
    }
}
