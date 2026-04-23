<?php

use App\Enums\FaqKind;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('kind')->default(FaqKind::Static->value);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->text('question_en');
            $table->text('question_ar');
            $table->text('answer_en')->nullable();
            $table->text('answer_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
