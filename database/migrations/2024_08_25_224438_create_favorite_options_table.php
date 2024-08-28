<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorite_options', function (Blueprint $table) {
            $table->id();
            $table->enum("time_type", ['day', 'month', 'year'])->default("day");
            $table->integer("time_count")->default(1);
            $table->integer("value_count")->default(0);
            $table->enum("value_type", ['percent', 'value'])->default("percent");
            $table->enum("option_type", ['fall', 'raise', 'all'])->default("all");
            $table->unsignedBigInteger("favorite_id");
            $table->string("name");
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite_options');
    }
};
