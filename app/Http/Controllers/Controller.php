<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createSlug($string)
    {

        $string = strtolower($string);

        $string = $this->removeAccents($string);

        $string = preg_replace('/[^a-z0-9]+/', '-', $string);


        $string = trim($string, '-');

        return $string;
    }

    // Hàm loại bỏ dấu tiếng Việt
    public function removeAccents($string)
    {
        return preg_replace(
            array(
                '/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/',
                '/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/',
                '/(ì|í|ị|ỉ|ĩ)/',
                '/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/',
                '/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/',
                '/(ỳ|ý|ỵ|ỷ|ỹ)/',
                '/(đ)/',
            ),
            array('a', 'e', 'i', 'o', 'u', 'y', 'd'),
            $string
        );
    }

    // Export file excel from database
    public function exportExcel($data, $fileName)
    {
        $fileName = $fileName . '.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Lấy ra tên các cột
        $titles = DB::getSchemaBuilder()->getColumnListing($data->first()->getTable());
        $columnIndex = 'A';
        foreach ($titles as $title) {
            $sheet->setCellValue($columnIndex . '1', $title);
            $columnIndex++;
        }
        // In đậm tiêu đề
        $sheet->getStyle('A1:' . $columnIndex . '1')->getFont()->setBold(true);
        // Tự động điều chỉnh độ rộng cột, căn giữa, xuống dòng
        foreach (range('A', $columnIndex) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            $sheet->getStyle($columnID)->getAlignment()->setVertical('center');
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
        } 

        $row = 2;
        foreach ($data as $item) {
            $columnIndex = 'A';
            foreach ($titles as $title) {
                $sheet->setCellValue($columnIndex . $row, $item->$title);
                $columnIndex++;
            }
            $row++;
        } 
        
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
