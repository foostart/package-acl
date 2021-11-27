<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateGroupsTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'groups';
        $this->prefix_column = 'group_';
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
            $table->string('name', 100);
            $table->text('permissions')->nullable();
            $table->boolean('protected')->default(0);

            // Set common columns
            $this->setCommonColumns($table);

            // Setup other attributes
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
        Schema::drop($this->table);
    }

}
