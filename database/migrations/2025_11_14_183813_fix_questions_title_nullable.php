<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Ubah title menjadi nullable sementara untuk testing
            if (Schema::hasColumn('questions', 'title')) {
                $table->string('title')->nullable()->change();
            } else {
                $table->string('title')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
        });
    }
};