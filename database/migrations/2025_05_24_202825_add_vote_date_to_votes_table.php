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
        Schema::table('votes', function (Blueprint $table) {
            if (!Schema::hasColumn('votes', 'vote_date')) {
                $table->timestamp('vote_date')->nullable()->after('vote_response');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            if (Schema::hasColumn('votes', 'vote_date')) {
                $table->dropColumn('vote_date');
            }
        });
    }
};
