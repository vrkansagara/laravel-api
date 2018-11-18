<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserDataAndUrlToLernTables extends Migration {

    use MigrationTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('lern.record.table'), function(Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->text('data')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();



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
        Schema::table(config('lern.record.table'), function(Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('data');
            $table->dropColumn('url');
            $table->dropColumn('method');
        });
    }

}
