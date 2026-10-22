<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentations', function (Blueprint $table) {
            $table->string('locale', 5)->default('en')->after('type');
        });

        DB::table('documentations')->whereNull('locale')->orWhere('locale', '')->update(['locale' => 'en']);

        Schema::table('documentations', function (Blueprint $table) {
            $table->dropUnique(['type']);
            $table->unique(['type', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::table('documentations', function (Blueprint $table) {
            $table->dropUnique(['type', 'locale']);
        });

        // Keep only English rows so the original unique(type) can be restored
        $duplicateTypes = DB::table('documentations')
            ->select('type')
            ->groupBy('type')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('type');

        foreach ($duplicateTypes as $type) {
            $keepId = DB::table('documentations')
                ->where('type', $type)
                ->where('locale', 'en')
                ->value('id');

            if (!$keepId) {
                $keepId = DB::table('documentations')
                    ->where('type', $type)
                    ->orderBy('id')
                    ->value('id');
            }

            DB::table('documentations')
                ->where('type', $type)
                ->where('id', '!=', $keepId)
                ->delete();
        }

        Schema::table('documentations', function (Blueprint $table) {
            $table->dropColumn('locale');
            $table->unique('type');
        });
    }
};
