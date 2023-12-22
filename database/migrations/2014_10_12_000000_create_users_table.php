<?php

declare(strict_types=1);

use App\Enums\Kind;
use App\Enums\UserState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('kind')->default(Kind::Elf->value);
            $table->string('status')->default(UserState::Wake->value);

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('experience')->default(0);
            $table->unsignedInteger('stars')->default(0);
            $table->unsignedInteger('health')->default(0);
            $table->unsignedInteger('max_health')->default(0);
            $table->unsignedInteger('crystal')->default(0);
            $table->unsignedInteger('max_crystal')->default(0);
            $table->unsignedInteger('action')->default(0);
            $table->unsignedInteger('max_action')->default(0);
            $table->unsignedInteger('weight')->default(0);
            $table->unsignedInteger('max_weight')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
