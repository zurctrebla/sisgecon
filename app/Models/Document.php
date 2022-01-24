<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['doc_no', 'emission', 'emission_for','uf'];

    public function documentable()
    {
        return $this->morphTo();
    }
}
