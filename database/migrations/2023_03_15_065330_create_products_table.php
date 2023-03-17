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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('tensp');
            $table->string('mota');
            $table->float('giaban',8,2);
            $table->float('gianhap',8,2);
            $table->string('anhdaidien');
            $table->integer('soluong');
            $table->timestamp('ngaytaosp');
            $table->boolean('spHot');
            $table->boolean('spMoi');
            $table->integer('idNguoiTaoSP');
            $table->integer('idloai');
            $table->integer('idThuongHieu');
            $table->integer('idHinh');
            $table->integer('idKM')->nullable;
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
        Schema::dropIfExists('products');
    }
};
