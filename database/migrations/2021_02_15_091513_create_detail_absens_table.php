<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_absens', function (Blueprint $table) {
            $table->id();

            $table->smallInteger('absensi_id');
            
            $table->enum('check', ['in', 'out'])->nullable();
            $table->string('status');
            $table->text('detail_status')->nullable();
            $table->text('detail_check')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('long')->nullable();
            $table->string('lang')->nullable();
            $table->text('location')->nullable();
            $table->text('image')->nullable();

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
        Schema::dropIfExists('detail_absens');
    }
}
