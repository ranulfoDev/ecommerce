<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 👉 Check muna kung existing bago mag-add
        if (!Schema::hasColumn('payments', 'transaction_id')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->string('transaction_id')->nullable()->after('status');
            });
        }

        if (!Schema::hasColumn('payments', 'payer_email')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->string('payer_email')->nullable()->after('transaction_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            if (Schema::hasColumn('payments', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }

            if (Schema::hasColumn('payments', 'payer_email')) {
                $table->dropColumn('payer_email');
            }

        });
    }
};