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
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'dui')) {
                $table->string('dui')->unique()->after('id');
            }

            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('dui'); // obligatorio para Breeze
            }

            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion')->after('name');
            }

            if (!Schema::hasColumn('users', 'fechanacimiento')) {
                $table->date('fechanacimiento')->nullable()->after('direccion');
            }

            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono')->after('fechanacimiento');
            }

            if (!Schema::hasColumn('users', 'rol')) {
                $table->string('rol')->default('Atencion al Cliente')->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'dui')) $table->dropColumn('dui');
            if (Schema::hasColumn('users', 'name')) $table->dropColumn('name');
            if (Schema::hasColumn('users', 'direccion')) $table->dropColumn('direccion');
            if (Schema::hasColumn('users', 'fechanacimiento')) $table->dropColumn('fechanacimiento');
            if (Schema::hasColumn('users', 'telefono')) $table->dropColumn('telefono');
            if (Schema::hasColumn('users', 'rol')) $table->dropColumn('rol');
        });
    }
};
