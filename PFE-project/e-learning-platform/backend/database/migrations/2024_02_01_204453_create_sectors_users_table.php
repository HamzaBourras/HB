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
        Schema::create('sectors_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('sectors_id')->unsigned();
            $table->unsignedBiginteger('users_id')->unsigned();

            $table->foreign('sectors_id')->references('id')
                 ->on('sectors')->onDelete('cascade');
            $table->foreign('users_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors_users');
    }
};
