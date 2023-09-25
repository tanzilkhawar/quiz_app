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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string("option");
            $table->unsignedBigInteger('question_id');
            $table->boolean('is_correct')->default(false);

            // Define the foreign key constraint
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade'); // You can choose the onDelete behavior that suits your needs

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            // Remove the foreign key constraint and the column
            $table->dropForeign(['question_id']);
            $table->dropColumn('question_id');
        });
        Schema::dropIfExists('answers');
    }
};
