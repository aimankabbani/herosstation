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
        DB::statement("
        UPDATE pages 
        SET title = CASE
            WHEN LOWER(title) IN ('home') THEN 'home'
            WHEN LOWER(title) IN ('about us', 'about') THEN 'about-us'
            WHEN LOWER(title) IN ('contact us', 'contact') THEN 'contact-us'
            WHEN LOWER(title) IN ('footer') THEN 'footer'
            ELSE title
        END
    ");

        DB::statement("
        ALTER TABLE pages 
        MODIFY COLUMN title ENUM('home', 'about-us', 'contact-us','footer') NOT NULL
    ");
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title')->change();
        });
    }
};
