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
        Schema::create('ab_article_image', function (Blueprint $table) {
            $table->tinyInteger('id')->primary()->unsigned();
            $table->foreign('id')
                ->references('id')
                ->on('ab_article')
                ->onDelete('cascade');
            $table->string('ab_img_filename', 80)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_article_image');
    }
};
