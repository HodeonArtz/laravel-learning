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
    Schema::create('films_directors', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('film_id');
      $table->unsignedBigInteger('director_id');
      $table->timestamp("created_at")->useCurrent();
      $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
      $table->foreign("director_id")->references("id")->on("directors")->onDelete("cascade");
      $table->foreign("film_id")->references("id")->on("films")->onDelete("cascade");
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('films_directors');
  }
};
