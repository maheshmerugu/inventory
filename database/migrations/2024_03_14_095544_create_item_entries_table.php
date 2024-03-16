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
        Schema::create('item_entries', function (Blueprint $table) {
            $table->id();
            $table->string('group_code');
            $table->string('item_name');
            $table->string('serial_number');
            $table->string('amc_warrenty');
            $table->tinyInteger('status')
            ->default(0)
            ->comment('1 - Installed, 0 - Delivered');       
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_entries');
    }
};
