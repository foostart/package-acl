<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreatePermissionTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'permission';
        $this->prefix_column = 'permission_';
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
            $table->string('overview', 500);
            $table->text('description');
            $table->string('url', 255);
            $table->string('permission');
            $table->boolean('protected')->default(0);

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
