<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('inside_dhaka')->default(0);
            $table->boolean('outside_dhaka')->default(0);
            $table->string('logo')->nullable();
            $table->string('app_title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
