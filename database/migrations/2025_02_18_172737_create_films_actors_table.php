<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('films_actors', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('film_id');
      $table->unsignedBigInteger('actor_id');
      $table->timestamp("created_at")->useCurrent();
      $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
      $table->foreign("actor_id")->references("id")->on("actors");
      $table->foreign("film_id")->references("id")->on("films");
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('films_actors');
  }
};
