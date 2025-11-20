<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_questions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Menyimpan ID user yang membuat pertanyaan
             $table->string('title')->nullable()->change(); // Judul pertanyaan
            $table->text('question');  // Isi pertanyaan
            $table->timestamps();
             $table->string('title')->default('Default Title')->change(); 

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
        
    }
}
