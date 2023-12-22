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
        Schema::create('exit_place', function (Blueprint $table) {
            $table->foreignUlid('place_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUlid('exit_id')->index()->constrained('places')->cascadeOnDelete();
            $table->string('direction');

            $table->primary(['place_id','exit_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_place');
    }
};
