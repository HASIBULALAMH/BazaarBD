<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /* =====================
        ROLE CONSTANTS
    ====================== */
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_VENDOR   = 'vendor';
    public const ROLE_ADMIN    = 'admin';

    /* =====================
        STATUS CONSTANTS
    ====================== */
    public const STATUS_ACTIVE  = 'active';
    public const STATUS_PENDING = 'pending';
    public const STATUS_BLOCKED = 'blocked';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', //  Hash auto
        ];
    }

    /* =====================
        ROLE CHECKS
    ====================== */
    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isVendor(): bool
    {
        return $this->role === self::ROLE_VENDOR;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /* =====================
        STATUS CHECK
    ====================== */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
