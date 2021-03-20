<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaikaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_identificacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',25)->unique();
            $table->timestamps();
        });

        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion',15)->unique();
            $table->string('nombre',25);
            $table->string('apellidos',50);
            $table->string('email',50)->unique()->nullable();
            $table->foreignId('tipo_identificacion_cod')->constrained('tipo_identificacion');
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
        // delete the table if is need it
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('tipo_identificacion');
    }
}
