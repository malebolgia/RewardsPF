<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRewardsTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
         public function up()
         {

            /**
             * Table: rewards
             */
            Schema::create('rewards', function($table) {
                $table->increments('id');
                $table->decimal('price', 8,2)->nullable();
                    $table->tinyInteger('status')->nullable();
    
                $table->string('slug', 100)->nullable();
                $table->integer('user_id')->nullable();
                $table->string('upload_folder', 100)->nullable();
                $table->softDeletes();
                $table->nullableTimestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
         public function down()
         {
                Schema::drop('rewards');
         }

}