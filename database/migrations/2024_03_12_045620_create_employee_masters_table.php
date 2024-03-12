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
        Schema::create('employee_masters', function (Blueprint $table) {
            $table->id();
             $table->string('employee_code');
             $table->string('employee_name')->nullable();
             $table->string('employee_designation')->nullable();
             $table->string('employee_mobile')->nullable();
             $table->string('employee_email')->nullable();
             $table->string('district')->nullable();
             $table->string('location')->nullable();

             $table->tinyInteger('status')
            ->default(1)
            ->comment('1 - Active, 0 - Inactive');  
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_masters');
    }
};
