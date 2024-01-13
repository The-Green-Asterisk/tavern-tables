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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 32)->unique();
            $table->string('code', 32)->unique();
        });

        DB::table('roles')->insert([
            ['name' => 'Admin', 'code' => 'AD'],
            ['name' => 'Tavern Keeper', 'code' => 'TK'],
            ['name' => 'Game Master', 'code' => 'GM'],
            ['name' => 'Player', 'code' => 'PL'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
