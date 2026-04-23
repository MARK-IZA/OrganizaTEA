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
        Schema::create('agenda_cells', function (Blueprint $table) {
            $table->id();

            // Relación con children
            $table->foreignId('child_id')->constrained()->onDelete('cascade');

            // Datos de la celda de la agenda
            $table->string('dia_semana');
            $table->integer('fila_orden');
            $table->time('hora_inicio')->nullable();
            $table->text('contenido')->nullable();
            $table->string('color')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_cells');
    }
};