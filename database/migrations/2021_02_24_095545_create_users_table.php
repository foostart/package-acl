<?php

use Illuminate\Database\Schema\Blueprint;
use Foostart\Category\Helpers\FoostartMigration;

class CreateUsersTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'users';
        $this->prefix_column = 'user_';
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
            $table->increments('id')->comment('User id');
            $table->string('email', 100)->comment('User email');
            $table->string('user_name', 100)->nullable()->comment('User name');
            $table->string('password')->comment('User password');
            $table->text('permissions')->nullable();
            $table->boolean('activated')->default(0);
            $table->boolean('banned')->default(0);
            $table->string('activation_code', 100)->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('persist_code')->nullable();
            $table->string('reset_password_code', 100)->nullable();
            $table->boolean('protected')->default(0);

            // Set common columns
            $this->setCommonColumns($table);

            // Setup other attributes
            $table->unique('email');
            $table->index('activation_code');
            $table->index('reset_password_code');
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
