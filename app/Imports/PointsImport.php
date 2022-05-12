<?php

namespace App\Imports;

use App\Models\Point;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PointsImport implements ToModel, WithBatchInserts, WithChunkReading
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Point([

            'pointable_type'    =>  $row[1],
            'pointable_id'      =>  $row[2],
            'register'          =>  $row[3],
            //
            'date'              =>  substr($row[3], 0, 10),
            'hour'              =>  substr($row[3], 11, 8),
            //
            'reason'            =>  $row[4],
            'reason_status'     =>  $row[5],
            'created_at'        =>  $row[6],
            'updated_at'        =>  $row[7],

        ]);
        // dd($points);
    }

    public function batchSize(): int
    {
        return 250;
    }

    public function chunkSize(): int
    {
        return 250;
    }
}
