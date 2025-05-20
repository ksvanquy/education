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
        // Bảng grades
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->timestamps();
            $table->softDeletes();
        });

        // Bảng subjects
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        // Bảng tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        // Bảng questions
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('grade_id');
            $table->string('title', 255);
            $table->text('content');
            $table->enum('status', ['unanswered', 'answered', 'first_time', 'deleted', 'pending', 'closed'])->default('unanswered');
            $table->enum('moderation_status', ['pending', 'approved', 'rejected'])->default('approved');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('grade_id')->references('id')->on('grades');
        });

        // Bảng answers
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id');
            $table->text('content');
            $table->boolean('is_accepted')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Bảng comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->text('content');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
        });

        // Bảng votes
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->enum('vote_type', ['up', 'down']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->unique(['user_id', 'question_id']);
            $table->unique(['user_id', 'answer_id']);
        });

        // Bảng notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->enum('type', ['answer', 'comment', 'other'])->default('answer');
            $table->string('content', 255)->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
        });

        // Bảng question_tags
        Schema::create('question_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['question_id', 'tag_id']);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        // Bảng question_follows
        Schema::create('question_follows', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['user_id', 'question_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_follows');
        Schema::dropIfExists('question_tags');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('votes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('grades');
    }
};