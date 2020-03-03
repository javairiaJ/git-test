<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->index();
            $table->string('title')->unique();
            $table->text('path')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->tinyInteger('deleted')->default(0)->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('modules');
    }

}
