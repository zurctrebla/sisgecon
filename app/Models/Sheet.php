<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = ['date', '1', '2', '3', '4', '5', '6', '7', '8', 'sum'];

    public function sheetable()
    {
        return $this->morphTo();
    }
}
