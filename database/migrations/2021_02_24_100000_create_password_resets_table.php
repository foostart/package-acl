<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreatePasswordResetsTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'password_resets';
        $this->prefix_column = 'password_resets_';
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
            $table->string('email', 100)->index();
            $table->string('token', 100)->index();

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
