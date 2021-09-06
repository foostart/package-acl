<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateProfileField extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'profile_field';
        $this->prefix_column = 'profile_field_';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->table);
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned()->index();
            $table->integer('profile_field_type_id')->unsigned();
            $table->string('value');
            // relations
            $table->foreign('profile_id')
                ->references('id')->on('user_profile')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('profile_field_type_id')
                ->references('id')->on('profile_field_type')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // indexes
            $table->unique(['profile_id', 'profile_field_type_id']);

            // Set common columns
            $this->setCommonColumns($table);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->table);
    }

}
