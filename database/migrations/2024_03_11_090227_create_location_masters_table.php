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
        Schema::create('location_masters', function (Blueprint $table) {
            $table->id();
            $table->string('location_code');
            $table->string('location_name');
            $table->string('location_short_name');
            $table->string('district');
            $table->string('address');
            $table->tinyInteger('status')
            ->default(1)
            ->comment('1 - Active, 0 - Inactive');  
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_masters');
    }
};
