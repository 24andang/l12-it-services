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
        Schema::create('p_c_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_c_users_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('unit');
            $table->ipAddress('ip_lan')->unique();
            $table->ipAddress('ip_wifi')->unique();
            $table->string('processor');
            $table->integer('ram');
            $table->integer('hdd');
            $table->integer('ssd');
            $table->integer('vga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_c_s');
    }
};
