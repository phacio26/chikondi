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
    Schema::create('about_pages', function (Blueprint $table) {
        $table->id();
        $table->string('hero_heading')->nullable();
        $table->text('hero_subheading')->nullable();
        $table->longText('story')->nullable();
        $table->longText('problem')->nullable();
        $table->text('mission')->nullable();
        $table->text('vision')->nullable();
        $table->text('values')->nullable();
        $table->longText('building')->nullable();
        $table->longText('impact')->nullable();
        $table->text('testimonial')->nullable();
        $table->text('team_teaser')->nullable();
        $table->string('cta_heading')->nullable();
        $table->text('cta_text')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
