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
        Schema::create('institutes', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('name');
            $table->string('subdomain')->unique();
            $table->string('location');
            $table->string('logo');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('established_year');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('type_id');
            $table->integer('nature_id');
            $table->integer('period_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('district_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'location', 'country_id', 'state_id', 'city_id', 'district_id']);

            $table->foreign('type_id')
                ->references('id')->on('types')
                ->onDelete('restrict');
            $table->foreign('nature_id')
                ->references('id')->on('natures')
                ->onDelete('restrict');
            $table->foreign('period_id')
                ->references('id')->on('periods')
                ->onDelete('restrict');
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('restrict');
            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onDelete('restrict');
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('restrict');
            $table->foreign('district_id')
                ->references('id')->on('districts')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
