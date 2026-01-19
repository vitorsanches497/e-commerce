<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Usuário dono do pedido
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Status do pedido
            $table->string('status')->default('pending');
            // pending | paid | shipped | delivered | canceled

            // Valor total
            $table->decimal('total', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
