<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('document1')->nullable();
            $table->string('document2')->nullable();
            $table->string('authorization')->unique();
            $table->string('photo')->nullable();
            $table->string('destiny');
            $table->enum('status', ['Pendente', 'Autorizado', 'Expirado', 'Bloqueado']);     //  acrescentada
            $table->string('authorized_at')->nullable();            //  acrescentada
            // $table->integer('destiny_id');
            $table->string('person');
            $table->string('company')->nullable();
            $table->text('obs')->nullable();
            $table->string('model')->nullable();
            $table->string('plate')->nullable();
            $table->date('start_at');
            $table->date('expires_at');
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
        Schema::dropIfExists('guests');
    }
}
