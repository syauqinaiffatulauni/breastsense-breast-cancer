<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('patient_name');
            $table->integer('age');
            $table->string('prediction_result');
            $table->float('confidence_score');

            $table->string('shape')->nullable();
            $table->string('margin')->nullable();
            $table->string('size')->nullable();

            $table->string('birads_score')->nullable();
            $table->string('risk_level')->nullable();

            $table->text('recommendation')->nullable();
            $table->string('reviewed_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_histories');
    }
};