<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
class SanPhamExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return SanPham::all();
    // }
    public function headings(): array
    {
        return [
            'loais',
            'hangsanxuat_id',
            'tensanpham',
            'tensanpham_slug',
            'soluong',
            'dongia',
            'hinhanh',
            ];
    }
    
    public function map($row): array
        {
            return [
            $row->loaisanpham_id,
            $row->hangsanxuat_id,
            $row->tensanpham,
            $row->tensanpham_slug,
            $row->soluong,
            $row->dongia,
            $row->hinhanh,
            ];
        }
    
 public function startCell(): string
 {
     return 'A1';
 }
 
 public function collection()
 {
    return SanPham::all();
 }
}
