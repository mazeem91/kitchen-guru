<?php

use App\Models\MemberBox;
use App\Models\Recipe;
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
        Schema::create('member_box_recipe', function (Blueprint $table) {
            $table->foreignIdFor(MemberBox::class);
            $table->foreignIdFor(Recipe::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_box_recipe');
    }
};
