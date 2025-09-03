<?php

namespace App\Imports;

use App\Models\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatasetSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Dataset([
            'karir' => $row['karir'],
            'preferensi' => $row['preferensi_lokasi_magang'],
            'p1' => $row['nilai_p1'],
            'p2' => $row['nilai_p2'],
            'p3' => $row['nilai_p3'],
            'p4' => $row['nilai_p4'],
            'p5' => $row['nilai_p5'],
            'p6' => $row['nilai_p6'],
        ]);
    }
}

