<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizingCommittesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizing_committes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo', 50)->nullable()->default(null);
            $table->string('name', 100);
            $table->string('position', 100);
            $table->string('description', 250)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizing_committes');
    }
}
