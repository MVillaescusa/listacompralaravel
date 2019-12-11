<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosuserTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('productosuser', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            
            $table->unique(['producto_id','user_id']);
            
            $table->foreign('producto_id')->references('id')
            ->on('productos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('productosuser');
    }
}
