<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplianceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliance_items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('item_group_id');
            $table->unsignedInteger('status_id');
            $table->string('item_name')->length(200);
            $table->text('item_description');
            $table->boolean('item_disable')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('compliance_items');
    }
}
