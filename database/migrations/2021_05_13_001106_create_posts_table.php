<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index(['user_id']);
        });

        DB::statement('ALTER TABLE posts ADD FULLTEXT post_title_index (title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropIndex('post_title_index');
        });

        Schema::dropIfExists('posts');
    }
}
