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
        Schema::create('ab_articlecategory', function (Blueprint $table) {
            $table->tinyInteger('id')->primary()->unsigned();
            $table->string('ab_name', 100)->nullable(false)->unique();
            $table->string('ab_description', 1000)->nullable(true);
            $table->tinyInteger('ab_parent')->unsigned()->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_articlecategory');
    }
};
