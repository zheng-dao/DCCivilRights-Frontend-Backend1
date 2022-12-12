<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('audio')->nullable();
            $table->longText('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->longText('content')->nullable();
            $table->longText('citation_info')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('sort')->nullable();
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
        Schema::dropIfExists('landmarks');
    }
}
