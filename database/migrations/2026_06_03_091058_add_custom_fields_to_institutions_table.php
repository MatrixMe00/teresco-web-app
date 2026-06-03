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
            // About Us & Stats
            $table->string('established_year')->nullable();
            $table->string('about_us_image')->nullable();
            $table->json('stats')->nullable();
            $table->json('timeline')->nullable();
            $table->json('community_impact')->nullable();
            $table->json('core_values')->nullable();

            // Principal
            $table->text('principal_bio')->nullable();
            $table->string('principal_qualifications')->nullable();

            // Vice Principal
            $table->string('vice_principal_name')->nullable();
            $table->string('vice_principal_photo')->nullable();
            $table->text('vice_principal_bio')->nullable();
            $table->string('vice_principal_qualifications')->nullable();
            $table->text('vice_principal_message')->nullable();

            // Registrar
            $table->string('registrar_name')->nullable();
            $table->string('registrar_photo')->nullable();
            $table->text('registrar_bio')->nullable();
            $table->string('registrar_qualifications')->nullable();
            $table->text('registrar_message')->nullable();

            // Service Charter
            $table->string('charter_title')->nullable();
            $table->text('charter_description')->nullable();
            $table->json('charter_items')->nullable();
            $table->string('charter_download_file')->nullable();
            $table->string('charter_audio_file')->nullable();
            $table->string('charter_image')->nullable();

            // Admissions Settings
            $table->boolean('accept_admissions_online')->default(true);
            $table->json('admission_fields_config')->nullable();
            $table->string('external_application_url')->nullable();
            $table->text('admission_requirements')->nullable();
            $table->text('admission_procedures')->nullable();
            $table->text('admission_guide')->nullable();

            // Footer Customization
            $table->text('footer_description')->nullable();
            $table->string('footer_copyright')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'established_year',
                'about_us_image',
                'stats',
                'timeline',
                'community_impact',
                'core_values',
                'principal_bio',
                'principal_qualifications',
                'vice_principal_name',
                'vice_principal_photo',
                'vice_principal_bio',
                'vice_principal_qualifications',
                'vice_principal_message',
                'registrar_name',
                'registrar_photo',
                'registrar_bio',
                'registrar_qualifications',
                'registrar_message',
                'charter_title',
                'charter_description',
                'charter_items',
                'charter_download_file',
                'charter_audio_file',
                'charter_image',
                'accept_admissions_online',
                'admission_fields_config',
                'external_application_url',
                'admission_requirements',
                'admission_procedures',
                'admission_guide',
                'footer_description',
                'footer_copyright',
            ]);
        });
    }
};
