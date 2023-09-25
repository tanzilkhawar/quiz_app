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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // Define the foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // You can choose the onDelete behavior that suits your needs
            $table->unsignedBigInteger('answer_id');
            // Define the foreign key constraint
            $table->foreign('answer_id')
                ->references('id')
                ->on('answers')
                ->onDelete('cascade'); // You can choose the onDelete behavior that suits your needs
            $table->unsignedBigInteger('question_id');
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
        Schema::table('results', function (Blueprint $table) {
            // Remove the foreign key constraint and the column
            $table->dropForeign(['question_id']);
            $table->dropColumn('question_id');
            // Remove the foreign key constraint and the column
            $table->dropForeign(['answer_id']);
            $table->dropColumn('answer_id')->nullable();
            // Remove the foreign key constraint and the column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('results');
    }
};
