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
        Schema::create('natural_resources', function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('type');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('action_point')->default(1);
            $table->unsignedInteger('experience_point')->default(1);
            $table->unsignedInteger('damage_point')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natural_resources');
    }
};
