<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CronjobsBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cronjob_blogs')) {
            Schema::create('cronjob_blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->longtext('content')->nullable();
                $table->string('categories')->nullable();
                $table->string('keywords')->nullable();
                $table->longtext('image')->nullable();
                $table->string('wp_status')->nullable();
                $table->integer('status')->default(0);
                $table->string('link')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cronjob_blogs');
    }
}
