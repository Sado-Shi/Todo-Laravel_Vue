<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('followers', function (Blueprint $table) {
      // 自分自身はfollowing_idになり、フォローしているユーザーはfollowed_id
      $table->foreignId('following_id')->constrained('users')->comment('フォローしているユーザーのID');
      $table->foreignId('followed_id')->constrained('users')->comment('フォローされているユーザーのID');

      $table->unique(['following_id', 'followed_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('followers');
  }
}
