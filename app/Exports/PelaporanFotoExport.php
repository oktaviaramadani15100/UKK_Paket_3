<?php

namespace App\Exports;

use App\Models\Foto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class PelaporanFotoExport implements FromCollection, WithHeadings
{
    use RegistersEventListeners;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Foto::where('id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Foto',
            'Deskripsi',
            'Tanggal Upload',
            'Foto',
            'Album_id',
            'User_id'
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // warna teks putih
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4285F4'], // warna latar biru
            ],
        ]);
    }
}
