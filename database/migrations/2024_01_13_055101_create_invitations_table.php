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
        Schema::create('invitation_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 32)->unique();
            $table->string('code', 32)->unique();
        });
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('table_id')->constrained('tables')->nullable();
            $table->foreignId('tavern_id')->constrained('taverns');
            $table->foreignId('inviter_id')->constrained('users');
            $table->dateTime('accepted_at')->nullable();
            $table->foreignId('invitation_status_id')->constrained('invitation_statuses');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('invitation_id')->nullable()->constrained('invitations');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('invitation_id')->nullable()->constrained('invitations');
        });

        DB::table('invitation_statuses')->insert([
            ['name' => 'Pending', 'code' => 'P'],
            ['name' => 'Accepted', 'code' => 'A'],
            ['name' => 'Declined', 'code' => 'D']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['invitation_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['invitation_id']);
        });

        Schema::dropIfExists('invitations');
        Schema::dropIfExists('invitation_statuses');
    }
};
