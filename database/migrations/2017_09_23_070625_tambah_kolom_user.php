<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('wilayah')->nullable();
            $table->string('link_afiliasi')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('an_rekening')->nullable();
            $table->integer('tipe_user')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->integer('komunitas')->nullable()->default(0);
            $table->integer('id_warung')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('wilayah');
            $table->dropColumn('link_afiliasi');
            $table->dropColumn('no_telp');
            $table->dropColumn('nama_bank');
            $table->dropColumn('no_rekening');
            $table->dropColumn('an_rekening');
            $table->dropColumn('tipe_user');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('komunitas');
            $table->dropColumn('id_warung');
        });
    }
}