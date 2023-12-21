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
        Schema::create('material_user', function (Blueprint $table): void {
            $table->foreignUlid('material_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUlid('user_id')->index()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(0);

            $table->primary(['material_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_user');
    }
};
