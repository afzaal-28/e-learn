<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Add new columns or make other modifications
            $table->string('new_column')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Drop the columns if rolled back
            $table->dropColumn('new_column');
        });
    }
    
}