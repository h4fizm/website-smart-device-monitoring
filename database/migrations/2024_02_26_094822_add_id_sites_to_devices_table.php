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
        Schema::table('devices', function (Blueprint $table) {
            //
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->unsignedBigInteger('id_sites'); // Foreign Key
            $table->foreign('id_sites')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['id_sites']);
            $table->dropColumn('id_sites');
        });
    }
};
