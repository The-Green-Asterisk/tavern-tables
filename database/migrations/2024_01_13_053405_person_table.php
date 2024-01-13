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
        Schema::create('person_table', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('person_id')->constrained('people');
            $table->foreignId('table_id')->constrained('tables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_table');
    }
};
