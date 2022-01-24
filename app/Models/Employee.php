<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [ 'sector_id', 'birth', 'function'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
