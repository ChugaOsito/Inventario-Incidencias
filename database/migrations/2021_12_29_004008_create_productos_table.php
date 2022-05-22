<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('codigos_id')->constrained('codigos')->nullable()->onDelete('cascade');
            $table->timestamp('fecha_ingreso');
            $table->timestamp('fecha_compra')->nullable();
            $table->timestamp('fecha_vencimiento')->nullable();
            $table->String('precio')->nullable();
            $table->String('precio_devaluado')->nullable();
            $table->String('vencimiento')->nullable();
            $table->string('serie')->unique();
            $table->text('descripcion');
            $table->text('caracteristicas');
            $table->string('imagen')->nullable();
            $table->softDeletes();

            
            $table->foreignId('user_id')->constrained('users')->unsigned()->nullable();
            $table->foreignId('estado_id')->constrained('estados')->nullable();
            $table->foreignId('marca_id')->constrained('marcas')->nullable();
            $table->foreignId('modelo_id')->constrained('modelos')->nullable();
            $table->foreignId('departamento_id')->constrained('departamentos')->nullable();
            
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
        Schema::dropIfExists('productos');
    }
}
