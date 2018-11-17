<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    private $table = 'profile';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            $this->table,
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->string('fname')->nullable();
                $table->string('mname')->nullable();
                $table->string('lname')->nullable();
                $table->ipAddress('ip');
                $table->text('json');
                $table->timestamps();
                $table->index('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
                $table->charset = 'utf8';
                $table->engine = 'InnoDB';
                $table->collation = 'utf8_unicode_ci';
            }
        );
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
