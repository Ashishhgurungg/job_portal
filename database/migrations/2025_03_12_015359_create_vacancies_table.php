<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            // now cascades when the user is deleted
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // now cascades when the category is deleted
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('title');
            $table->string('type');
            $table->text('description');
            $table->unsignedInteger('salary')->nullable();
            $table->datetime('deadline');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
