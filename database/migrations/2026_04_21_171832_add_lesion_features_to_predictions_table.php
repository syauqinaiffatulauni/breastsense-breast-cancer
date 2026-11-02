<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('predictions', function (Blueprint $table) {
            $table->string('shape')->nullable();
            $table->string('margin')->nullable();
            $table->string('size')->nullable();
            $table->string('risk_level')->nullable();
            $table->text('recommendation')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('predictions', function (Blueprint $table) {
            $table->dropColumn([
                'shape',
                'margin',
                'size',
                'risk_level',
                'recommendation'
            ]);
        });
    }
};