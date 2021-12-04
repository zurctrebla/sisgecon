<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'document', 'photo', 'destiny', 'person', 'company', 'obs', 'start_at', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
