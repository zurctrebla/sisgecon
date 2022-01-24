<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;

    protected $fillable = ['doc_no', 'emission', 'emission_for','uf'];

    public function docable()
    {
        return $this->morphTo();
    }

}
