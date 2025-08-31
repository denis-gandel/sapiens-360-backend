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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code');
            $table->integer('period');
            $table->integer('level_id');
            $table->integer('program_id');
            $table->boolean('is_active')->default(true);
            $table->json('subjects')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('tenant_id');

            $table->foreign('tenant_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
