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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('konsumen');
            $table->string('alamat');
            $table->enum('paket_kuota', [
                'KUOTA CUCI SETRIKA, 50Kg => 275000',
                'KUOTA CUCI SETRIKA, 60Kg => 324000',
                'KUOTA CUCI SETRIKA, 70Kg => 371000',
                'KUOTA CUCI SETRIKA, 80Kg => 416000',
                'KUOTA CUCI SETRIKA, 90Kg => 459000',
                'KUOTA CUCI SETRIKA, 100Kg => 500000',
                'KUOTA SETRIKA, 50Kg => 225000',
                'KUOTA SETRIKA, 60Kg => 264000',
                'KUOTA SETRIKA, 70Kg => 301000',
                'KUOTA SETRIKA, 80Kg => 336000',
                'KUOTA SETRIKA, 90Kg => 369000',
                'KUOTA SETRIKA, 100Kg => 400000',
            ]);
            $table->string('berat');
            $table->string('harga');
            $table->string('pembayaran');
            $table->string('total');
            $table->string('cabang');
            $table->enum('status', ['Aktif', 'Nonaktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
