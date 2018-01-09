<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeContactUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_contact_uses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic');
            $table->string('background_path');
            $table->timestamps();
        });

        \DB::table('welcome_contact_uses')->insert([
            'topic' => 'ارتباط با ما',
            'background_path' => 'contact/bg.png',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('welcome_contact_uses');
    }
}
