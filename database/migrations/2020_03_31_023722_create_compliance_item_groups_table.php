<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplianceItemGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliance_item_groups', function (Blueprint $table) {
            $table->increments('item_group_id');
            $table->integer('packages_id')->unsigned();
            $table->string('item_group_name')->length(200);
            $table->text('item_group_description');
            $table->boolean('item_group_implemented');
            $table->boolean('item_group_disable')->default(0);
            $table->timestamps();

            $table->foreign('packages_id')->references('packages_id')->on('compliance_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compliance_item_groups');
    }
}
