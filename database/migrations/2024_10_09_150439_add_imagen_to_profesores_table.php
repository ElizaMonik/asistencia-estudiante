<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_imagen_to_profesores_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToProfesoresTable extends Migration
{
    public function up()
    {
        Schema::table('profesores', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('apellido');
        });
    }

    public function down()
    {
        Schema::table('profesores', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}