<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('title');
            $table->string('body');
            $table->boolean('read')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
