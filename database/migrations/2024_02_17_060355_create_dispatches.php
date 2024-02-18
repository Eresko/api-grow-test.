<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Название рассылки");
            $table->boolean('daily')->comment("Статус ежедневности");
            $table->time('time')->comment("время отправки");
            $table->text('text')->comment("тест отправки");
            $table->integer('before')->comment("кол-во дней от даты с которой отправлять");
            $table->integer('after')->comment("кол-о дней до даты с которой отправлять");
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
        Schema::dropIfExists('dispatches');
    }
}
