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
        Schema::create('ab_article', function (Blueprint $table) {
            $table->tinyInteger('id')->primary()->unsigned();
            $table->string('ab_name', 80)->nullable(false);
            $table->integer('ab_price')->nullable(false);
            $table->string('ab_description', 1000)->nullable(false);
            $table->tinyInteger('ab_creator_id')->nullable(false)->unsigned();
            $table->timestamp('ab_createdate')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_article');
    }
};
