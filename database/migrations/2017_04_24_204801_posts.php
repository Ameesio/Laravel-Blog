<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class Posts extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('author_id') -> unsigned() ->default(0);
            $table->foreign('author_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->string('username');
            $table->string('title',255);
            $table->text('content');
            $table->string('tags', 255);
            $table->string('color', 255)->default('#FFFFFF');
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
