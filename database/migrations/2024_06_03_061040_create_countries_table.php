<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('mobile_ex')->nullable();
            $table->string('call_key')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('active_orders')->nullable();
            $table->string('sort')->nullable();
            $table->string('active')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('countries');
    }
}
