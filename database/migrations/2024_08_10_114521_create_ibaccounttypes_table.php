<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbAccountTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ib_accounttypes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('group');
            $table->string('badge');
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ib_accounttypes');
    }
}
