<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ClusteringImport implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            'Dataset' => new DatasetSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // Handle the case when the sheet is not found
        info("Sheet {$sheetName} was skipped");
    }
}
