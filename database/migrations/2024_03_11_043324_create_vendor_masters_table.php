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
        Schema::create('vendor_masters', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id');
            $table->string('vendor_name');
            $table->string('vendor_email');
            $table->string('vendor_phone');
            $table->string('vendor_city');
            $table->string('vendor_address');
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
        Schema::dropIfExists('vendor_masters');
    }
};
