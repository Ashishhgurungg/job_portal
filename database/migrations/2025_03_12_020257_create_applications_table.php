<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // cascades when the user is deleted
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // cascades when the vacancy is deleted
            $table->foreignId('vacancy_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('resume');
            $table->text('cover_letter');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
