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
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');

        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // NULL = global menu
            // value = site specific menu
            $table->foreignId('site_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title_ar');
            $table->string('title_en');

            $table->string('url')->nullable();

            $table->foreignId('page_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
