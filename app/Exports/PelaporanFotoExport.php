<?php

namespace App\Exports;

use App\Models\Foto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;

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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $photos = Foto::whereIn('id', $this->id)->get();
                $row = 2;

                foreach ($photos as $photo) {
                    $imagePath = public_path('images/' . $photo->LokasiFIle);

                    if (file_exists($imagePath)) {
                        $imageFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($imagePath);
                        $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                        $objDrawing->setName('Photo');
                        $objDrawing->setDescription('Photo');
                        $objDrawing->setPath($imagePath);
                        $objDrawing->setCoordinates('E' . $row);
                        $objDrawing->setWorksheet($event->sheet->getDelegate());
                        $row++;
                    }
                }
            },
        ];
    }
}
