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

            // Relation
            $table->integer('category_id')->nullable()->comment('Category ID');

            $table->string('name')->comment('Permission name');
            $table->string('permission')->comment('Permission slug');
            $table->boolean('protected')->default(0);
            $table->text('description')->nullable()->comment('Permission description');

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
