<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountItemGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_item_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('packages_id')->unsigned();
            $table->integer('item_group_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('account_id')->references('account_id')->on('accounts');
            $table->foreign('packages_id')->references('packages_id')->on('compliance_packages');
            $table->foreign('item_group_id')->references('item_group_id')->on('compliance_item_groups');
            $table->foreign('status_id')->references('status_id')->on('item_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_item_groups');
    }
}
