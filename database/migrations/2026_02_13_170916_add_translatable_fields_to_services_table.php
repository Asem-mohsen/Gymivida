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
        Schema::table('services', function (Blueprint $table) {
            // Add temporary JSON columns
            $table->json('title_translations')->nullable()->after('title');
            $table->json('description_translations')->nullable()->after('description');
        });

        // Backfill existing data
        $services = DB::table('services')->get();
        foreach ($services as $service) {
            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'title_translations' => json_encode([
                        'en' => $service->title,
                        'ar' => $service->title, // TODO: Replace with actual Arabic translation
                    ]),
                    'description_translations' => json_encode([
                        'en' => $service->description ?? '',
                        'ar' => $service->description ?? '', // TODO: Replace with actual Arabic translation
                    ]),
                ]);
        }

        // Drop old columns and rename new ones using raw SQL
        DB::statement('ALTER TABLE services DROP COLUMN title, DROP COLUMN description');
        DB::statement('ALTER TABLE services CHANGE title_translations title JSON NOT NULL');
        DB::statement('ALTER TABLE services CHANGE description_translations description JSON NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Add back string columns
            $table->string('title_temp')->after('id');
            $table->text('description_temp')->after('title_temp');
        });

        // Extract English values
        $services = DB::table('services')->get();
        foreach ($services as $service) {
            $titleTranslations = json_decode($service->title, true);
            $descriptionTranslations = json_decode($service->description, true);
            
            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'title_temp' => $titleTranslations['en'] ?? '',
                    'description_temp' => $descriptionTranslations['en'] ?? '',
                ]);
        }

        // Drop JSON columns and rename temp ones
        DB::statement('ALTER TABLE services DROP COLUMN title, DROP COLUMN description');
        DB::statement('ALTER TABLE services CHANGE title_temp title VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE services CHANGE description_temp description TEXT NOT NULL');
    }
};
