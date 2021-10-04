<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('reseller_tenant_name')->nullable();
            $table->string('reseller_internal_username')->nullable();
            $table->integer('reseller_tenant_channel_limit')->nullable();
            $table->boolean('billing_inclusive')->nullable();
            $table->integer('reseller_tenant_id')->nullable();
            $table->string('account_code')->nullable();
            $table->integer('status')->default(0);
            $table->integer('reseller_id');
            $table->dateTime('created_date')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->unique(['id', 'reseller_tenant_id', 'reseller_id'], 'tenants_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant');
    }
}
