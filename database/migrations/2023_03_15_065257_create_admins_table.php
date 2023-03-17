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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('hoten');     // tạo thuộc tính name trong bảng user có kiểu dl ;à string
            $table->string('sdt')->unique();  // ->unique - thuộc tính ko đc trùng dl
            $table->string('email')->unique();     //nullable được phép rỗng
            $table->string('username')->unique();
            $table->string('password');
            $table->string('vitri');
            $table->integer('idquyen');
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
        Schema::dropIfExists('admins');
    }
};
