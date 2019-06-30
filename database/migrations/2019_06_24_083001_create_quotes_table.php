<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quote_number');
            $table->string('c_name');
            $table->string('c_email');
            $table->string('c_contact');
            $table->mediumText('address_1');
            $table->mediumText('address_2');
            $table->string('city');
            $table->integer('post_code');
            $table->decimal('grand_total', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->mediumText('comment');
            $table->date('expiry_date'); 
            $table->tinyInteger('status');    
            $table->mediumText('reject_reason');   
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
        Schema::dropIfExists('quotes');
    }
}
