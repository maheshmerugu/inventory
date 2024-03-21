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
        Schema::create('item_masters', function (Blueprint $table) {
            $table->id();
            $table->string('group_name', 255);
            $table->string('item_code', 255);
            $table->string('item_name', 255);
            $table->integer('pn')->nullable();
            $table->integer('critical')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 - Active, 0 - InActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_masters');
    }
};
