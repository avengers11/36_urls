<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->string("title") -> nullable();
            $table->string("category_id") -> nullable();
            $table->string("og") -> nullable();
            $table->string("uniqeKey") -> nullable();
            $table->string("url") -> nullable();
            $table->string("auth") -> default(0);
            $table->string("view_page") -> nullable(0);
            $table->string("time") -> nullable(0);
            $table->longText("custom_page") -> nullable(0);
            $table->string("view") -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
};
