<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{

    use MigrationTrait;
    private $table = 'blog';

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


                $table->string('title');
                $table->string('description')->nullable();
                $table->string('keywords')->nullable();
                $table->string('slug');
                $table->text('content');
                $table->string('canonical_link')->nullable();
                $table->enum('status', ['publish', 'draft', 'inactive', 'schedule'])->default('draft');
                $table->string('featured_image');
                $table->dateTime('publish_at');
                $table->integer('created_by')->unsigned();
                $table->integer('updated_by')->unsigned()->nullable();
                $table->timestamps();
                $table->softDeletes();



                $table->index('created_by');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

                $table->index('updated_by');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

                $table->charset = $this->dbconfig['charset'];
                $table->engine = $this->dbconfig['engine'];
                $table->collation = $this->dbconfig['collation'];
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
