<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Laadt het createscript Database_jamin.sql (tabellen + relaties + seed-data).
     */
    public function up(): void
    {
        DB::unprepared(file_get_contents(database_path('migrations/Database_jamin.sql')));
    }

    /**
     * Draait de import terug; tabellen worden in omgekeerde volgorde gedropt
     * vanwege de foreign keys.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('DROP TABLE IF EXISTS ProductPerLeverancier');
        DB::statement('DROP TABLE IF EXISTS ProductPerAllergeen');
        DB::statement('DROP TABLE IF EXISTS Magazijn');
        DB::statement('DROP TABLE IF EXISTS Leverancier');
        DB::statement('DROP TABLE IF EXISTS Allergeen');
        DB::statement('DROP TABLE IF EXISTS Product');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
