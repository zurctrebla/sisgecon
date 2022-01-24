<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['birth', 'function', 'sector', 'rg', 'emission', 'emission_for', 'uf'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
