<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('about_hero_subtitle')->nullable();
            $table->string('about_us_title')->nullable();
            $table->string('values_title')->nullable();
            $table->text('values_description')->nullable();
            $table->string('journey_title')->nullable();
            $table->text('journey_description')->nullable();
            $table->string('impact_title')->nullable();
            $table->text('impact_description')->nullable();

            // Section visibility toggles
            $table->boolean('show_values_section')->default(true);
            $table->boolean('show_stats_section')->default(true);
            $table->boolean('show_journey_section')->default(true);
            $table->boolean('show_impact_section')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'about_hero_subtitle',
                'about_us_title',
                'values_title',
                'values_description',
                'journey_title',
                'journey_description',
                'impact_title',
                'impact_description',
                'show_values_section',
                'show_stats_section',
                'show_journey_section',
                'show_impact_section',
            ]);
        });
    }
};
