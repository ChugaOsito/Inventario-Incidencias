<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciaActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('responsable')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('severity', 1)->nullable();

            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('support_id')->nullable()->constrained('users');
            $table->foreignId('producto_id')->constrained('productos');

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
        Schema::dropIfExists('incidencia_activity_logs');
    }
}
