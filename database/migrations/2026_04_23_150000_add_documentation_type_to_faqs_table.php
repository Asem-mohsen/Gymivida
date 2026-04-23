<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('documentation_type', 32)->nullable()->after('answer_ar');
        });

        if (Schema::hasTable('faqs')) {
            DB::table('faqs')
                ->where('question_en', 'How do I list my gym on Gymivida?')
                ->update([
                    'documentation_type' => 'documentation',
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('documentation_type');
        });
    }
};
