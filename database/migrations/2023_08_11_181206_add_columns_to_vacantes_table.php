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
        Schema::table('vacantes', function (Blueprint $table) {
            $table->string('titulo');
            $table->foreignId('salario_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->string('empresa');
            $table->date('ultimo_dia');
            $table->text('descripcion');
            $table->string('imagen');
            //Esto para no eliminar todo el registro, solo para ocultarlo, como cliente inactivo activo etc. tu me entiendes..
            $table->integer('publicado')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacantes', function (Blueprint $table) {

            /* Primero eliminamos los FK para evitar el error 1828 de SQL al intentar eliminar una columna relacionada con otra tabla */
            $table->dropForeign('vacantes_categoria_id_foreign');
            $table->dropForeign('vacantes_salario_id_foreign');
            $table->dropForeign('vacantes_user_id_foreign');
            /* Como son muchos campos, lo ponemos en un array */
               $table->dropColumn(['titulo','salario_id','categoria_id',
               'empresa','ultimo_dia','descripcion','imagen','publicado','user_id']);
        });
    }
};
