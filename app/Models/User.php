<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'username',
      'name',
      'email',
      'password',
      'pangkat_id',
      'jabatan',
      'unit_id',
      'den_id',
      'last_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasRole($role) {
      return $this->role === $role;
    }

    public function role_name()
    {
      return $this->getRoleNames()[0];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pangkat() {
      return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }

    public function den() {
      return $this->belongsTo(Den::class, 'den_id');
    }

    public function unit() {
      return $this->belongsTo(Unit::class, 'unit_id');
    }
}
