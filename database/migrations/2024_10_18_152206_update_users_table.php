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
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('first_name');
            $table->bigInteger('nt_id')->after('last_name');
            $table->string('image')->nullable()->after('nt_id');
            $table->string('phone')->nullable()->after('image');
            $table->string('profession')->nullable()->after('phone');
            $table->string('biography')->nullable()->after('profession');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('nt_id');
            $table->dropColumn('image');
            $table->dropColumn('phone');
            $table->dropColumn('profession');
            $table->dropColumn('biography');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
