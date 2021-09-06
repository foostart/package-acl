<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateProfileFieldTypes extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'profile_field_type';
        $this->prefix_column = 'profile_field_type_';
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
            $table->string('description');

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
