<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('col1');
            $table->string('col2');
            $table->string('col3');
            $table->string('col4');
            $table->string('col5');
            $table->string('col6');
            $table->string('col7');
            $table->string('col8');
            $table->string('col9');
            $table->string('col10');
            $table->string('col11');
            $table->string('col12');
            $table->string('col13');
            $table->string('col14');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imports');
    }
}
