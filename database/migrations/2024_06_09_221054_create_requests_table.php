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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('issue');
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->enum('status', ['In Queue', 'On Process', 'Waiting Client Confirm', 'Done']);
            $table->date('request_date');
            $table->date('finish_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
