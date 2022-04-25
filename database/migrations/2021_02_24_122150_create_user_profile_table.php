<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateUserProfileTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'user_profile';
        $this->prefix_column = 'user_profile_';
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
            $table->integer('user_id')->unsigned()->index();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('device_token', 500)->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->binary('avatar')->nullable();
            $table->string('code', 25)->nullable();
            $table->string('vat', 20)->nullable();
            $table->string('state', 20)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->smallInteger('sex')->default(0);
            $table->string('address', 100)->nullable();

            // Set common columns
            $this->setCommonColumns($table);

            // foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
