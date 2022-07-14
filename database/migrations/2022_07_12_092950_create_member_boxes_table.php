<?php

use App\Models\User;
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
        Schema::create('member_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('delivery_date');
            $table->timestamps();
            $table->index('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_boxes');
    }
};
