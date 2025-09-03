<?php

namespace App\Imports;

use App\Models\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClusteringImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Dataset([
            'karir' => $row['karir'],
            'preferensi' => $row['preferensi'],
            'p1' => $row['p1'],
            'p2' => $row['p2'],
            'p3' => $row['p3'],
            'p4' => $row['p4'],
            'p5' => $row['p5'],
            'p6' => $row['p6']
        ]);
    }
}
