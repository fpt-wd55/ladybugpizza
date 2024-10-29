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

        return view('admins.banner.index', compact('banners'));
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
        if ($request->hasFile('image')) {
            $banner_image = $request->file('image');
            $banner_name ='banner_'.time() . pathinfo($banner_image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $banner_image->getClientOriginalExtension();
            $banner_image->storeAs('public/uploads/banners', $banner_name);
        }

       $data=[
            'image' => $banner_name,
            'url' => $request->url,
            'is_local_page' => $request->is_local_page,
            'status' => $request->status ? 1 : 2,
        ];
        if( Banner::create($data)){
            return redirect()->route('admin.banners.index')->with('success', 'thêm thành công');
        }else{
            return redirect()->back()->with('error', 'Thêm thất bại');
        }

    } 

    public function edit(Banner $banner)
    {
        return view('admins.banner.edit', compact('banner'));
    }

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
            return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $id = $banner['id'];
        if(Banner::destroy($id)){
            return redirect()->back()->with('success', 'Xóa thành công');
        }else{
            return redirect()->back()->with('error', 'Xóa thất bại');
        }

    }

    public function trashList(Banner $banner)
    {
        $deleteBanner = Banner::onlyTrashed()->paginate(10);

        return view('admins.banner.trash', compact('deleteBanner'));
    }
    // xóa cứng
    public function trashForce(string $id)
    {
        $banner = Banner::withTrashed()->find($id);
        $old_banner = $banner->image;
        // dd($old_banner);
        $filePath = storage_path('app/public/uploads/banners/' . $old_banner);
        if ($old_banner != null && file_exists($filePath)) {
            unlink($filePath);
        }
        if($banner->forceDelete()){
            return back()->with('success', 'Đã xóa vĩnh viễn !');
        }else{
            return back()->with('error', 'Xóa vĩnh viễn thất bại !');
        }
        
    }

    // khôi phục
    public function trashRestore(string $id)
    {
        $restoreBanner = Banner::withTrashed()->find($id);

        if ($restoreBanner) {
            $restoreBanner->restore();
            return redirect()->back()->with('success', 'Banner đã được khôi phục thành công');
        }else{
            return redirect()->back()->with('error', 'Banner khôi phục thất bại');
        }
    }
    public function export(){
        $this->exportExcel(Banner::all(), 'danhsachbanner');
    }
}
