<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;

class Log extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'logs';

    protected $fillable = [
        'timestamp', 'user_id', 'ipaddress', 'action', 'description', 'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
