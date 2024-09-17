<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->time('reservation_time');
            $table->date('reservation_day');
            $table->integer('number_of_people')->nullable(false);
            $table->tinyInteger('status')->default(0)->comment('0=予約、1=チェックイン、2=キャンセル');
            $table->enum('payment_status', ['pending','completed','failed'])->default('pending'); //支払いステータス
            $table->decimal('amount', 8, 2)->nullable();//支払い金額
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
        Schema::dropIfExists('reservations');
    }
}
