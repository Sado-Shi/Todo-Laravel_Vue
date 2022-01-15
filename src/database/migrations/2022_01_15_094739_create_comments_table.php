<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      //user_id(post_id)はuser(post)テーブルのidを外部キーとする
      $table->foreignId('user_id')->constrained()->comment('ユーザID');
      $table->foreignId('post_id')->constrained()->comment('ツイート投稿ID');
      $table->string('text')->comment('コメント本文');
      $table->softDeletes();
      $table->timestamps();

      $table->index(['user_id', 'post_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('comments');
  }
}
