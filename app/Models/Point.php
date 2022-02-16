<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['register', 'reason', 'reason_status', 'data_ocorrencia', 'hora_ocorrencia'];

    public function pointable()
    {
        return $this->morphTo();
    }
}
