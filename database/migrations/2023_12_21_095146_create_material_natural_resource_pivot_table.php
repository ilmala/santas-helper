<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_natural_resource', function (Blueprint $table): void {
            $table->foreignUlid('material_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUlid('natural_resource_id')->index()->constrained()->cascadeOnDelete();

            $table->unsignedInteger('min_quantity')->default(1);
            $table->unsignedInteger('max_quantity')->default(1);

            $table->primary(['material_id', 'natural_resource_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_natural_resource');
    }
};
