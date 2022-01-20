<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    public function phones()
    {
        return $this->hasOne(Phone::class);
    }

    /**
     * Get vehicles
     */
    public function vehicles()
    {
        //return $this->hasOne(Models\Vehicle::class);
        return $this->hasMany(Vehicle::class);   /** um para muitos */
    }

    /**
     * Get complement
     */
    public function complement()
    {
        return $this->hasOne(Complement::class);
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
     * Get sheets
     */
    public function sheets()
    {
        //return $this->hasOne(Models\Vehicle::class);
        return $this->hasMany(Sheet::class);   /** um para muitos */
    }

    /**
     * Get sheets
     */
    public function latestSheet()
    {
        //return $this->hasOne(Models\Vehicle::class);
        return $this->hasOne(Sheet::class)->latestOfMany();   /** um para muitos */
    }

    public function points()
    {
        return $this->morphMany(Point::class, 'pointable');
    }
}
