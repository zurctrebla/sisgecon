<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = ['in', 'rest_out', 'rest_in', 'out', 'status'];

    // protected $dates = ['in'];

    // public function getInAttribute($value)
    // {
    //     return date('d/m/Y H:m:s', strtotime($value));
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
