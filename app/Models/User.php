<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'password', 'status', 'role_id', 'department', 'last_login', 'two_factor_auth', 'session_timeout', 'email_notification', 'push_notification', 'sms_notification', 'timezone', 'language'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', '_id');
    }
}

