<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get guests
     */
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
