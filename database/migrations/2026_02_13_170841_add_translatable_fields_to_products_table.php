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
        Schema::table('products', function (Blueprint $table) {
            // Add temporary JSON columns
            $table->json('name_translations')->nullable()->after('name');
            $table->json('description_translations')->nullable()->after('description');
        });

        // Backfill existing data
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'name_translations' => json_encode([
                        'en' => $product->name,
                        'ar' => $product->name, // TODO: Replace with actual Arabic translation
                    ]),
                    'description_translations' => json_encode([
                        'en' => $product->description ?? '',
                        'ar' => $product->description ?? '', // TODO: Replace with actual Arabic translation
                    ]),
                ]);
        }

        // Drop old columns and rename new ones using raw SQL
        DB::statement('ALTER TABLE products DROP COLUMN name, DROP COLUMN description');
        DB::statement('ALTER TABLE products CHANGE name_translations name JSON NOT NULL');
        DB::statement('ALTER TABLE products CHANGE description_translations description JSON NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add back string columns
            $table->string('name_temp')->after('id');
            $table->text('description_temp')->nullable()->after('name_temp');
        });

        // Extract English values
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            $nameTranslations = json_decode($product->name, true);
            $descriptionTranslations = json_decode($product->description, true);
            
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'name_temp' => $nameTranslations['en'] ?? '',
                    'description_temp' => $descriptionTranslations['en'] ?? null,
                ]);
        }

        // Drop JSON columns and rename temp ones
        DB::statement('ALTER TABLE products DROP COLUMN name, DROP COLUMN description');
        DB::statement('ALTER TABLE products CHANGE name_temp name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE products CHANGE description_temp description TEXT NULL');
    }
};
