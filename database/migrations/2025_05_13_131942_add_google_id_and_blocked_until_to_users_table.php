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
            $table->string('google_id')->nullable()->after('email_verified_at');
            $table->timestamp('blocked_until')->nullable()->after('google_id');
            $table->timestamp('register_date')->useCurrent()->after('blocked_until');
        });
    }


};
