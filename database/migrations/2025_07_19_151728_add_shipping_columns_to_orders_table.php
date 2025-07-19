<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_address')->after('total_amount');
            $table->string('shipping_city')->after('shipping_address');
            $table->string('shipping_postal_code')->after('shipping_city');
            $table->string('payment_method')->after('shipping_postal_code');
            $table->string('status')->default('pending')->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_address',
                'shipping_city',
                'shipping_postal_code',
                'payment_method',
                'status',
            ]);
        });
    }
};
