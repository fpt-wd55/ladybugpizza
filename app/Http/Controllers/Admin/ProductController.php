<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\EvaluationImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admins.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admins.product.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        // Xử lý số lượng sản phẩm
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $quantity = $category->attributes->count() > 0 ? 0 : $request->quantity;
        }

        // Dữ liệu
        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => trim($request->category_id),
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];

        // Lưu vào database
        if (Product::create($data)) {
            // Xử lý lưu ảnh
            $image->storeAs('public/uploads/products', $image_name);
            // Thông báo
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm sản phẩm thất bại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        return view('admins.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // Xử lý ảnh
        $old_image = $product->image;
        $image_name = $old_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        // Xử lý số lượng sản phẩm
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $quantity = $category->attributes->count() > 0 ? 0 : $request->quantity;
        }

        // Dữ liệu
        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => trim($request->category_id),
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];

        // Lưu vào database
        if ($product->update($data)) {
            // Xử lý lưu ảnh
            if ($request->hasFile('image')) {
                $image->storeAs('public/uploads/products', $image_name);
                // Kiểm tra tồn tại ảnh cũ 
                if (file_exists(storage_path('app/public/uploads/products/' . $old_image))) {
                    unlink(storage_path('app/public/uploads/products/' . $old_image));
                }
            }
            // Thông báo
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        return view('admins.product.trash', compact('products'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product->restore()) {
            return redirect()->back()->with('success', 'Khôi phục sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Khôi phục sản phẩm thất bại');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product) {
            // Kiểm tra tồn tại ảnh sản phẩm
            if (file_exists(storage_path('app/public/uploads/products/' . $product->image))) {
                unlink(storage_path('app/public/uploads/products/' . $product->image));
            }
            $product->forceDelete();
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
    }
    // phần Đánh Giá
    public function listComment(String $id)
    {
        $sanpham = Product::query()->findOrFail($id);
        $evaluations = Evaluation::where('product_id', $id)->with('order')->paginate(10);
        $images = [];

        foreach ($evaluations as $evaluation) {
            $images[$evaluation->id] = EvaluationImage::where('evaluation_id', $evaluation->id)->get();
        }
        return view('admins.evaluations.edit', compact('sanpham', 'evaluations', 'images'));
    }

    public function export()
    {
        $products = Product::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên sản phẩm');
        $sheet->setCellValue('C1', 'Slug');
        $sheet->setCellValue('D1', 'Mô tả');
        $sheet->setCellValue('E1', 'Danh mục');
        $sheet->setCellValue('F1', "Giá ban đầu\n(VNĐ)");
        $sheet->setCellValue('G1', "Giá khuyến mãi\n(VNĐ)");
        $sheet->setCellValue('H1', 'Số lượng');
        $sheet->setCellValue('I1', 'Mã sản phẩm');
        $sheet->setCellValue('J1', "Trạng thái\n(1: Hoạt động, 2: Khóa)");
        $sheet->setCellValue('K1', 'Nổi bật');
        $sheet->setCellValue('L1', 'Đánh giá trung bình');
        $sheet->setCellValue('M1', 'Tổng đánh giá');
        $sheet->setCellValue('N1', 'Ngày xóa');
        $sheet->setCellValue('O1', 'Ngày tạo');
        $sheet->setCellValue('P1', 'Ngày cập nhật');
        // In đậm tiêu đề
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        // Tự động điều chỉnh độ rộng cột
        foreach (range('A', 'P') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            $sheet->getStyle($columnID)->getAlignment()->setVertical('center');
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
        }

        $row = 2;
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->id);
            $sheet->setCellValue('B' . $row, $product->name);
            $sheet->setCellValue('C' . $row, $product->slug);
            $sheet->setCellValue('D' . $row, $product->description);
            $sheet->setCellValue('E' . $row, $product->category->name);
            // Giá là vietnamese đồng
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('F' . $row, $product->price);
            $sheet->setCellValue('G' . $row, $product->discount_price);
            $sheet->setCellValue('H' . $row, $product->quantity);
            $sheet->setCellValue('I' . $row, $product->sku);
            $sheet->setCellValue('J' . $row, $product->status);
            $sheet->setCellValue('K' . $row, $product->is_featured);
            $sheet->setCellValue('L' . $row, $product->avg_rating);
            $sheet->setCellValue('M' . $row, $product->total_rating);
            $sheet->setCellValue('N' . $row, $product->deleted_at);
            $sheet->setCellValue('O' . $row, $product->created_at);
            $sheet->setCellValue('P' . $row, $product->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="danhsachsanpham.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
