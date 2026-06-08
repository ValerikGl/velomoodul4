<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->decimal('weight', 5, 1)->nullable()->after('battery');
            $table->string('charging_time')->nullable()->after('weight');
            $table->json('features')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'weight',
                'charging_time',
                'features',
            ]);
        });
    }
};