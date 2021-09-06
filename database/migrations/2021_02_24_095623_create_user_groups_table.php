<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateUserGroupsTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'users_groups';
        $this->prefix_column = 'users_groups_';
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
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();

            // Set common columns
            $this->setCommonColumns($table);

            // Setup other attributes
            $table->primary(array('user_id', 'group_id'));
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
