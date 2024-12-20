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
        Schema::create('formsib', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('username');
            $table->string('country');
            $table->string('email');
            $table->string('user_country');
            $table->integer('expected_clients');
            $table->string('services');
            $table->decimal('trading_volume', 8, 2);
            $table->integer('active_clients');

            $table->text('background_options')->nullable();
            $table->text('selectable_options')->nullable();
            $table->boolean('terms_agreement')->default(false); // Add terms_agreement field
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
        Schema::dropIfExists('formsib');
    }
};
