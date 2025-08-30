<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id")->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string("firstnames");
            $table->string("lastnames");
            $table->string("shortname");
            $table->string("code")->nullable();
            $table->string("ci");
            $table->string("image_url")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->unique();
            $table->string("password");
            $table->char("gender");
            $table->date("birthdate")->nullable();
            $table->integer("role_id");
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid("lms_id")->nullable();
            $table->uuid("tenant_id");

            $table->foreign("tenant_id")
                ->references("id")->on("institutes")
                ->onDelete("cascade");
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
