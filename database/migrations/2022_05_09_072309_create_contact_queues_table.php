<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId("contact_id")->constrained()->cascadeOnDelete();
            $table->foreignId("sender_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("receiver_id")->constrained("users")->cascadeOnDelete();
            $table->enum("status", [0, 1])->default(0); // 0 is pending , 1 is accept , if denied delete record
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
        Schema::dropIfExists('contact_queues');
    }
};
