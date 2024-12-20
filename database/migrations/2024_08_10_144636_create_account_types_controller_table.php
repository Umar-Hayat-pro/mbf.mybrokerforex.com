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
        Schema::create('account_types_controller', function (Blueprint $table) {
                $table->id(); // Auto-incrementing ID
                $table->integer('priority'); // Priority of the account type
                $table->string('title'); // Title of the account type
                $table->integer('leverage'); // Leverage for the account type
                $table->string('country'); // Associated country
                $table->string('badge'); // Path to the badge image
                $table->enum('status', ['Active', 'Inactive']); // Status of the account type
                $table->timestamps(); // Created at and updated at timestamps
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_types_controller');
    }
};
