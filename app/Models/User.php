<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Comment\Doc;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',  /** acrescentar para criar usuário */
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get phones
     */
    public function phone()
    {
        return $this->morphOne(Phone::class, 'phoneable');
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

    // /**
    //  * Get document
    //  */
    // public function documents()
    // {
    //     return $this->morphMany(Document::class, 'documentable');
    // }

    /**
     * Get document
     */
    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }

    /**
     * Get relatives
     */
    public function relatives()
    {
        // return $this->hasOne(Models\Relative::class);
        return $this->hasMany(Relative::class);
    }

    /**
     * Get guests
     */
    public function guests()
    {
        // return $this->hasOne(Models\Relative::class);
        return $this->hasMany(Guest::class);
    }

    /**
     * Get employee
     */
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Get Points
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
}
