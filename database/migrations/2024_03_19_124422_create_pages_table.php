<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_section_id')->nullable();
            $table->foreign('page_section_id')->references('id')->on('page_sections');
            $table->string('page_name');
            $table->string('page_url');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active, 0 - InActive');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
