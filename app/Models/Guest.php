<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sector_id', 'name', 'authorization', 'photo', 'status', 'authorized_at', 'person', 'company', 'obs', 'start_at', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get sector
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Get points
     */
    public function points()
    {
        return $this->morphMany(Point::class, 'pointable');
    }

    /**
     * Get Sheets
     */
    public function sheets()
    {
        return $this->morphMany(Point::class, 'sheetable');
    }

    /**
     * Get vehicles
     */
    public function vehicles()
    {
        //return $this->hasOne(Models\Vehicle::class);
        //return $this->hasMany(Vehicle::class);   /** um para muitos */
        return $this->morphMany(Vehicle::class, 'vehicleable');
    }

    /**
     * Get document
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
