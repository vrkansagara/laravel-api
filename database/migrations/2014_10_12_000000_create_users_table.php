<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('active')->default(false);
            $table->boolean('verify')->default(false);
            $table->boolean('agree')->default(false);
            $table->softDeletes();

            $table->rememberToken();
            $table->timestamps();


            $table->charset = $this->dbconfig['charset'];
            $table->engine = $this->dbconfig['engine'];
            $table->collation = $this->dbconfig['collation'];

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
