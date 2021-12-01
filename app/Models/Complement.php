<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nacionality', 'state', 'birth', 'cpf', 'rg', 'block', 'lot', 'house'];

    // protected $dates = ['birth'];

    // public function getBirthAttribute($value)
    // {
    //     return date('d/m/Y', strtotime($value));
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
