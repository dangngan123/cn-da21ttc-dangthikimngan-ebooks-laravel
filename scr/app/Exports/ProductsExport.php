<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    use Exportable;


    protected $selectItems;
    public function __construct($selectItems)
    {
        $this->selectItems = $selectItems;
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->short_description,
            $product->long_description,
            $product->publisher,
            $product->author,
            $product->age,
            $product->reguler_price,
            $product->sale_price,
            $product->quantity,
            $product->image,
            $product->images,
            $product->category_id,


        ];
    }







    public function headings(): array
    {
        return [
            'Tên sản phẩm',
            // 'Trạng thái',
            'Mô tả ngắn',
            'Mô tả dài',
            'Nhà xuất bản',
            'Tác giả',
            'Độ tuổi',
            'Giá gốc',
            'Giảm giá',
            'Số lượng',
            'Ảnh chính',
            'Ảnh phụ ',
            'Danh mục',



        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 25,
    //         'B' => 25,
    //         'C' => 25,
    //         'D' => 25,

    //         'F' => 25,
    //         'H' => 25,
    //         'I' => 25,
    //         'J' => 25,
    //         'K' => 25,

    //     ];
    // }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($product) {
            $product->offer .= ' (%)';

            return $product;
        });
    }






    public function query()
    {
        return Product::whereIn('id', $this->selectItems);
    }
}
