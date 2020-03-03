<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email')->unique();
            $table->integer('role_id')->index()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('image')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('isConfirmed')->index()->default(0);
            $table->string('key')->unique()->nullable();
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
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
