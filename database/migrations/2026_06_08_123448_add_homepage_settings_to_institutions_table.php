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
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('hero_badge')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('history_title')->nullable();
            $table->text('history_description')->nullable();
            $table->string('history_image')->nullable();
            $table->json('homepage_stats')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge',
                'hero_description',
                'history_title',
                'history_description',
                'history_image',
                'homepage_stats',
            ]);
        });
    }
};
