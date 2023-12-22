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
        Schema::create('natural_resource_place', function (Blueprint $table) {
            $table->foreignUlid('natural_resource_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUlid('place_id')->index()->constrained()->cascadeOnDelete();

            $table->unsignedInteger('quantity')->default(1);

            $table->primary(['natural_resource_id','place_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natural_resource_place');
    }
};
