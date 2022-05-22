<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('responsable')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('serie')->nullable();
            $table->string('number')->nullable();
            
            $table->foreignId('departamento_id')->constrained('departamentos')->nullable();
            
            $table->string('modyfy_user')->nullable();
            $table->string('date_time')->nullable();

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
        Schema::dropIfExists('producto_activity_logs');
    }
}
