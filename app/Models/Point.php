<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['register', 'date', 'hour', 'reason', 'reason_status'];

    public function pointable()
    {
        return $this->morphTo();
    }
}
