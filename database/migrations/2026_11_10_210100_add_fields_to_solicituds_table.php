<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->string('nombres', 120);
            $table->string('apellidos', 120);
            $table->string('barrio', 120);
            $table->string('comuna_corregimiento', 120);
            $table->string('celular', 30);
            $table->string('direccion', 255);
            $table->string('punto_atencion', 80);
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['created_at']);
            $table->dropColumn([
                'nombres', 'apellidos', 'barrio', 'comuna_corregimiento',
                'celular', 'direccion', 'punto_atencion', 'latitud', 'longitud', 'user_id',
            ]);
        });
    }
};
