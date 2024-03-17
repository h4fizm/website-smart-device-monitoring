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
        Schema::create('devices', function (Blueprint $table) {
            $table->id('id_devices');
            $table->unsignedBigInteger('id_sites'); // Foreign Key
            $table->foreign('id_sites')->references('id')->on('sites')->onDelete('cascade');
            $table->string('device_name');
            $table->tinyInteger('status')->default(0); // 0 for OFF, 1 for ON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
