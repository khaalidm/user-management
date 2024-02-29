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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('surname')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->string('id_number')->nullable(false)->unique();
            $table->string('phone')->nullable(false);
            $table->dateTime('birth_date')->nullable(false);
            $table->enum('language', ['english', 'spanish', 'french', 'german', 'italian'])->nullable(false);
            $table->json('interests')->nullable(false);
            $table->timestamp('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
