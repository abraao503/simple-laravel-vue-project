<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficTable extends Migration
{
    public function up()
    {
        Schema::create('traffic', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('visitor')->unique();
            $table->bigInteger('visits')->default('0');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('traffic');
    }
}
