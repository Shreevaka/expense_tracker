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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_no', 20)->nullable()->unique()->after('email');
            $table->string('preferred_currency', 10)->nullable()->after('contact_no');
            $table->boolean('is_active')->default(true)->after('preferred_currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_no');
            $table->dropColumn('preferred_currency');
            $table->dropColumn('is_active');
        });
    }
};
