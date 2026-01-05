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
        Schema::table('sites', function (Blueprint $table) {
            // Rename 'name' to 'name_en'
            $table->renameColumn('slogan', 'slogan_en');
        });

        Schema::table('sites', function (Blueprint $table) {
            // Now 'name_en' exists, add 'name_ar' after it
            $table->string('slogan_ar')->after('slogan_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            //
        });
    }
};
