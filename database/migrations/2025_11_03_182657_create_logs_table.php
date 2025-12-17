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
        Schema::connection('mongodb')->create('logs', function ($collection) {
            $collection->timestamp('timestamp')->useCurrent();
            $collection->objectId('user_id'); 
            $collection->string('ipaddress')->nullable();
            $collection->string('action')->nullable();
            $collection->string('description')->nullable();
            $collection->string('location')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
