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
        Schema::create('achats', function (Blueprint $table) {
            $table->string('numAchat')->primary();
            $table->string('idCli')->index()->cascadeOnUpdate();
            $table->foreign('idCli')->references('idCli')->on('Clients');
            $table->string('idVoit')->index()->cascadeOnUpdate();
            $table->foreign('idVoit')->references('idVoit')->on('Voitures');
            $table->date('date');
            $table->integer('qte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats');
    }
};
