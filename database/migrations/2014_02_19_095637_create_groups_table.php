<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('groups');
        Schema::create('groups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('permissions')->nullable();
            $table->boolean('protected')->default(0);
            $table->timestamps();
            // setup index
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

}
