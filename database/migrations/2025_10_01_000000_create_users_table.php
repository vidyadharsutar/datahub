<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mongodb')->create('users', function ($collection) {
            $collection->string('firstname');
            $collection->string('lastname');
            $collection->string('email')->unique();
            $collection->string('phone')->nullable();
            $collection->objectId('role_id'); // reference to roles
            $collection->string('password');
            $collection->enum('status', ['active', 'inactive'])->default('active');
            $collection->string('department')->nullable();
            $collection->timestamp('last_login')->nullable();
            $collection->enum('two_factor_auth', [1, 0])->default(0);
            $collection->enum('session_timeout', [30, 15, 5])->default(30);
            $collection->enum('email_notification', [1, 0])->default(0);
            $collection->enum('push_notification', [1, 0])->default(0);
            $collection->enum('sms_notification', [1, 0])->default(0);
            $collection->string('timezone')->nullable();
            $collection->string('language')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('users');
    }
};
