<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rulesets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 32)->unique();
            $table->string('code', 32)->unique();
        });

        DB::table('tables', function (Blueprint $table) {
            $table->foreignId('ruleset_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulesets');
        DB::table('tables', function (Blueprint $table) {
            $table->dropForeign(['ruleset_id']);
        });
    }
};
