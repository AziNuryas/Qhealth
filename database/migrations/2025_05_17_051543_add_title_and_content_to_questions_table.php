<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_title_and_content_to_questions_table.php
public function up()
{
    Schema::table('questions', function (Blueprint $table) {
         $table->string('title')->default('Default Title')->change(); 
        $table->text('content');
    });
}

public function down()
{
    Schema::table('questions', function (Blueprint $table) {
        $table->dropColumn(['title', 'content']);
         $table->string('title')->nullable()->change();
    });
}

};
