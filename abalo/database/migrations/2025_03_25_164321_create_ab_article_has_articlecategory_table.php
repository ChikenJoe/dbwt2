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
        Schema::create('ab_article_has_articlecategory', function (Blueprint $table) {
            $table->tinyInteger('id')->primary()->unsigned();
            $table->tinyInteger('ab_articlecategory_id')->unsigned()->nullable(false);
            $table->tinyInteger('ab_article_id')->unsigned()->nullable(false);
            $table->unique(['ab_articlecategory_id', 'ab_article_id'], 'ab_unique_article_combo_ab_articlecategory_id
            _and_ab_article_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_article_has_articlecategory');
    }
};
