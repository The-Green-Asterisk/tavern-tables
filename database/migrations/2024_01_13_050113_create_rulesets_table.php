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

        Schema::table('tables', function (Blueprint $table) {
            $table->foreignId('ruleset_id')->nullable()->constrained();
        });

        DB::table('rulesets')->insert(
            ['name' => 'D&D 5e', 'code' => 'DD5'],
            ['name' => 'D&D 3.5e', 'code' => 'DD35'],
            ['name' => 'Traveler', 'code' => 'TR'],
            ['name' => 'GURPS', 'code' => 'GURPS'],
            ['name' => 'Cyberpunk 2020', 'code' => 'CP'],
            ['name' => 'Vampire: The Masquerade', 'code' => 'VTM'],
            ['name' => 'Vampire: The Requiem', 'code' => 'VTR'],
            ['name' => 'Werewolf: The Apocalypse', 'code' => 'WTA'],
            ['name' => 'Werewolf: The Forsaken', 'code' => 'WTF'],
            ['name' => 'Mage: The Ascension', 'code' => 'MTA'],
            ['name' => 'Mage: The Awakening', 'code' => 'MTW'],
            ['name' => 'Changeling: The Dreaming', 'code' => 'CTD'],
            ['name' => 'Changeling: The Lost', 'code' => 'CTL'],
            ['name' => 'Wraith: The Oblivion', 'code' => 'WTO'],
            ['name' => 'Promethean: The Created', 'code' => 'PTC'],
            ['name' => 'Hunter: The Reckoning', 'code' => 'HTR'],
            ['name' => 'Hunter: The Vigil', 'code' => 'HTV'],
            ['name' => 'Demon: The Fallen', 'code' => 'DTF'],
            ['name' => 'Demon: The Descent', 'code' => 'DTD'],
            ['name' => 'Mummy: The Resurrection', 'code' => 'MTR'],
            ['name' => 'Mummy: The Curse', 'code' => 'MTC'],
            ['name' => 'Scion', 'code' => 'SC'],
            ['name' => 'Exalted', 'code' => 'EX'],
            ['name' => 'Legend of the Five Rings', 'code' => 'L5R'],
            ['name' => 'Legend of the Five Rings 5e', 'code' => 'L5R5'],
            ['name' => 'Pathfinder', 'code' => 'PF'],
            ['name' => 'Starfinder', 'code' => 'SF'],
            ['name' => 'Shadowrun', 'code' => 'SR'],
            ['name' => 'Call of Cthulhu', 'code' => 'COC']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulesets');
        Schema::table('tables', function (Blueprint $table) {
            $table->dropForeign(['ruleset_id']);
        });
    }
};
