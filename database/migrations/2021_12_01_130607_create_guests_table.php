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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');
            $table->string('name');
            $table->string('authorization')->unique();
            $table->string('photo')->nullable();
            // $table->string('destiny');
            // $table->integer('destiny_id');
            $table->enum('status', ['Pendente', 'Autorizado', 'Expirado', 'Bloqueado']);     //  acrescentada
            $table->string('authorized_at')->nullable();                                    //  acrescentada
            $table->string('person');
            $table->string('company')->nullable();
            $table->text('obs')->nullable();
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
