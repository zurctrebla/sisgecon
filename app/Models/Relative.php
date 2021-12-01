<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'relationship'];

    public function user()
    {
        return $this->BelongsTo(Relative::class);
    }
}
