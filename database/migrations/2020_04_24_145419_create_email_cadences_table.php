<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailCadencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_cadences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('cadence_id');
            $table->integer('email_template_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('subname');
            $table->string('bodyname');
            $table->string('temp');
            $table->enum('delivered', ['YES', 'NO'])->default('NO');
            $table->text('body')->nullable();
            $table->string('date_string')->nullable();
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
        Schema::dropIfExists('email_cadences');
    }
}
