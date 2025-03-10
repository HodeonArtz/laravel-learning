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
    Schema::create('directors', function (Blueprint $table) {
      $table->id();
      $table->string("name", 30);
      $table->string("surname", 30);
      $table->date("birthdate");
      $table->string("country", 30);
      $table->integer("amount_of_awards");
      $table->timestamp("created_at")->useCurrent();
      $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('directors');
  }
};
